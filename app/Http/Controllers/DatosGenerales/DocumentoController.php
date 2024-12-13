<?php

namespace App\Http\Controllers\DatosGenerales;

use App\Http\Controllers\Controller;
use App\Models\Documento;
use App\Models\TipoDocumento;
use App\Models\EstadoDocumento;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Log;

/*clases Min*/
use App\Services\MinStorageService;

class DocumentoController extends Controller
{
    protected $minStorage;

    public function __construct(MinStorageService $minStorage)
    {
        $this->minStorage = $minStorage;
    }
    public function index(Request $request)
    {
        $keyword = $request->input('search');
        $query = Documento::orderBy('created_at', 'desc');

        if ($keyword) {
            $query->where('titulo', 'like', "%{$keyword}%")
                ->orWhere('numero', 'like', "%{$keyword}%")
                ->orWhere('sumilla', 'like', "%{$keyword}%");
        }

        $documentos = $query->paginate(10);
        // Transformar las URLs de los documentos usando getUrl
        
        $documentos->getCollection()->transform(function ($documento) {
            $documento->url = $this->minStorage->getUrl($documento->url); // Reemplaza el valor de URL con la URL completa
            return $documento;
        });
        
        $tipos = TipoDocumento::all();
        $estados = EstadoDocumento::all();
        $documentos->appends(['search' => $keyword]);
       // dd($documentos->items());
        return view('documentos.crud.index', compact('documentos', 'tipos', 'estados', 'keyword'));
    }

    public function create()
    {
        $tipos = TipoDocumento::all();
        $estados = EstadoDocumento::all();
        return view('documentos.crud.create', compact('tipos', 'estados'));
    }

    public function store(Request $request)
    {
        try {
            // Validar los datos del formulario, incluyendo tipo y tamaño del archivo
            $request->validate([
                'archivo' => 'required|file|mimes:pdf|max:102400', // Solo PDF, máximo 100 MB
                'idtipo_documento' => 'required|exists:tipo_documentos,id', // Validar tipo de documento
                'numero' => 'required|string',
                'fecha' => 'required|date',
                'sumilla' => 'required|string',
                'idestado' => 'required|integer',
            ]);

            // Obtener el tipo de documento
            $tipoDocumento = TipoDocumento::findOrFail($request->idtipo_documento);

            // Configurar la ruta de almacenamiento
            $year = date('Y', strtotime($request->fecha));
            $folderPath = 'documentos/' . $year . '/' . $tipoDocumento->Carpeta;

            // Generar el título concatenado
            $tituloConcatenado = $tipoDocumento->titulo . " N° " . $request->numero . '-' . $year;

            // Verificar duplicados en la base de datos (título)
            if (Documento::where('titulo', $tituloConcatenado)->exists()) {
                return back()->withErrors(['titulo' => 'Ya existe un documento con el mismo título.']);
            }

            // Validar que el archivo está presente en la solicitud y sea válido
            if (!$request->hasFile('archivo') || !$request->file('archivo')->isValid()) {
                return back()->withErrors(['archivo' => 'Debe seleccionar un archivo válido para subir.']);
            }

            // Obtener el archivo y generar el nombre deseado
            $archivo = $request->file('archivo');
            $fileName = $tipoDocumento->Abreviatura . '_' . $request->numero . '.pdf';

            // Subir el archivo al almacenamiento
            $resultado = $this->minStorage->uploadFile($archivo, $folderPath, $fileName);

            // Verificar que el archivo se subió correctamente
            if (empty($resultado['ruta'])) {
                return back()->withErrors(['archivo' => 'No se pudo subir el archivo. Inténtelo nuevamente.']);
            }
            // dd($request->idtipo_documentost);
            // Crear el registro en la base de datos
            Documento::create([
                'idtipo_documento' => $request->idtipo_documento,
                'numero' => $request->numero,
                'fecha' => $request->fecha,
                'sumilla' => $request->sumilla,
                'url' => $resultado['ruta'],
                'idestado' => $request->idestado,
                'titulo' => $tituloConcatenado,
            ]);

            // Redireccionar con mensaje de éxito
            return redirect()->route('datos-generales.documentos.index')->with('success', 'Documento creado exitosamente.');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Error si no se encuentra el tipo de documento
            return back()->withErrors(['idtipo_documento' => 'El tipo de documento no existe.']);
        } catch (\Exception $e) {
            // Manejo de errores generales
            return back()->withErrors(['error' => 'Ha ocurrido un error: ' . $e->getMessage()]);
        }
    }





    public function edit(Documento $documento)
    {
        $tipos = TipoDocumento::all();
        $estados = EstadoDocumento::all();
        return view('documentos.crud.edit', compact('documento', 'tipos', 'estados'));
    }

    public function update(Request $request, Documento $documento)
    {
        // Validar los datos del formulario
        $this->validateDocumento($request);

        try {
            // Obtener el tipo de documento
            $tipoDocumento = TipoDocumento::findOrFail($request->idtipo_documento);

            // Configurar carpeta y nombre del archivo
            $year = date('Y', strtotime($request->fecha));
            $folderPath = 'documentos/' . $year . '/' . $tipoDocumento->Carpeta;
            $fileName = $tipoDocumento->Abreviatura . '_' . $request->numero . '.pdf';
            $tituloConcatenado = $tipoDocumento->titulo . " N° " . $request->numero . '-' . $year;

            // Verificar duplicados en el título
            if (Documento::where('titulo', $tituloConcatenado)->where('id', '!=', $documento->id)->exists()) {
                return back()->withErrors(['titulo' => 'Ya existe un documento con el mismo título.']);
            }

            // Manejo del archivo (si se cargó un nuevo archivo)
            if ($request->hasFile('archivo') && $request->file('archivo')->isValid()) {
                // Eliminar archivo antiguo
                if (!empty($documento->url) && $this->minStorage->fileExists($documento->url)) {
                    $deleteResult = $this->minStorage->deleteFile($documento->url);
                   // dd($deleteResult);
                    if (isset($deleteResult['error']) && $deleteResult['error']) {
                        throw new \Exception('Error al eliminar el archivo antiguo: ' . $deleteResult['message']);
                    }
                }

                // Subir el nuevo archivo
                $uploadResult = $this->minStorage->uploadFile($request->file('archivo'), $folderPath, $fileName);
                if (empty($uploadResult['ruta'])) {
                    throw new \Exception('No se pudo subir el nuevo archivo.');
                }

                // Actualizar la URL del archivo en el documento
                $documento->url = $uploadResult['ruta'];
            }

            // Actualizar los datos del documento
            $documento->update([
                'idtipo_documento' => $request->idtipo_documento,
                'numero' => $request->numero,
                'fecha' => $request->fecha,
                'sumilla' => $request->sumilla,
                'url' => $documento->url,
                'idestado' => $request->idestado,
                'titulo' => $tituloConcatenado,
                'fechapubli' => $documento->fechapubli ?? now(),
                'html' => $documento->html ?? null,
            ]);

            // Redireccionar con mensaje de éxito
            return redirect()->route('datos-generales.documentos.index')->with('success', 'Documento actualizado exitosamente.');
        } catch (\Exception $e) {
            // Registrar el error y redirigir con mensaje
            \Log::error('Error en la actualización del documento: ' . $e->getMessage());
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }



    public function destroy(Documento $documento)
    {
        // Renombrar el archivo en lugar de eliminarlo
        if (!empty($documento->url) && $this->minStorage->fileExists($documento->url)) {
            $deleteResult = $this->minStorage->deleteFile($documento->url);
           // dd($deleteResult);
            if (isset($deleteResult['error']) && $deleteResult['error']) {
                throw new \Exception('Error al eliminar el archivo antiguo: ' . $deleteResult['message']);
            }
        }

        $documento->delete();
        return redirect()->route('datos-generales.documentos.index')->with('success', 'Documento eliminado exitosamente.');
    }

    private function validateDocumento(Request $request)
    {
        $request->validate([
            'idtipo_documento' => 'required',
            'numero' => 'required|string|max:100',
            'fecha' => 'required|date',
            'sumilla' => 'required|string|max:800',
            'url' => 'nullable|file|mimes:pdf', // Cambiado a tipo archivo, acepta solo PDF
            'idestado' => 'required',
            'titulo' => 'string',
        ]);
    }
}
