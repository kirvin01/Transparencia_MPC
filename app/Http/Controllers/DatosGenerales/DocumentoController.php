<?php

namespace App\Http\Controllers\DatosGenerales;

use App\Http\Controllers\Controller;
use App\Models\Documento;
use App\Models\TipoDocumento;
use App\Models\EstadoDocumento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentoController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('search');
        $query = Documento::orderBy('fecha', 'desc');

        if ($keyword) {
            $query->where('titulo', 'like', "%{$keyword}%")
                  ->orWhere('numero', 'like', "%{$keyword}%")
                  ->orWhere('sumilla', 'like', "%{$keyword}%");
        }

        $documentos = $query->paginate(10);
        $tipos = TipoDocumento::all();
        $estados = EstadoDocumento::all();
        $documentos->appends(['search' => $keyword]);

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
        $this->validateDocumento($request);

        $tipoDocumento = TipoDocumento::find($request->idtipo_documento);
       

        // Configurar la ruta de almacenamiento: documentos/<año>/<Carpeta>
        $year = date('Y', strtotime($request->fecha));
        $folderPath = 'documentos/' . $year . '/' . $tipoDocumento->Carpeta;
        $fileName = $tipoDocumento->Abreviatura . '_' . $request->numero . '.pdf';
        $fullPath = $folderPath . '/' . $fileName;

        $tituloConcatenado = $tipoDocumento->titulo . " N° " . $request->numero.'-'. $year;

        // Verificar duplicados en el campo 'titulo' y 'url'
        if (Documento::where('titulo', $tituloConcatenado)->exists()) {
            return back()->withErrors(['titulo' => 'Ya existe un documento con el mismo título.']);
        }

        if (file_exists(storage_path('app/public/' . $fullPath))) {
            return back()->withErrors(['url' => 'Ya existe un archivo con el mismo nombre.']);
        }

        // Guardar el archivo en la ruta configurada
        if ($request->hasFile('url') && $request->file('url')->isValid()) {
            $request->file('url')->storeAs($folderPath, $fileName, 'public');
        }

        Documento::create([
            'idtipo_documento' => $request->idtipo_documento,
            'numero' => $request->numero,
            'fecha' => $request->fecha,
            'sumilla' => $request->sumilla,
            'url' => $fullPath,
            'idestado' => $request->idestado,
            'titulo' => $tituloConcatenado,
        ]);

        return redirect()->route('datos-generales.documentos.index')->with('success', 'Documento creado exitosamente.');
    }

    public function edit(Documento $documento) 
    {
        $tipos = TipoDocumento::all();
        $estados = EstadoDocumento::all();
        return view('documentos.crud.edit', compact('documento', 'tipos', 'estados'));
    }

    public function update(Request $request, Documento $documento)
    {
        $this->validateDocumento($request);

        $tipoDocumento = TipoDocumento::find($request->idtipo_documento);
       

        // Configurar la ruta de almacenamiento
        $year = date('Y', strtotime($request->fecha));
        $folderPath = 'documentos/' . $year . '/' . $tipoDocumento->Carpeta;
        $fileName = $tipoDocumento->Abreviatura . '_' . $request->numero . '.pdf';
        $fullPath = $folderPath . '/' . $fileName;
        $tituloConcatenado = $tipoDocumento->titulo . " N° " . $request->numero.'-'.$year;


        // Verificar duplicados en el campo 'titulo' y 'url'
        if (Documento::where('titulo', $tituloConcatenado)->where('id', '!=', $documento->id)->exists()) {
            return back()->withErrors(['titulo' => 'Ya existe un documento con el mismo título.']);
        }

        if ($request->hasFile('url') && file_exists(storage_path('app/public/' . $fullPath)) && $fullPath != $documento->url) {
            return back()->withErrors(['url' => 'Ya existe un archivo con el mismo nombre.']);
        }

        // Eliminar el archivo anterior si se va a cargar uno nuevo
        if ($request->hasFile('url') && $request->file('url')->isValid()) {
            if (file_exists(storage_path('app/public/' . $documento->url))) {
                unlink(storage_path('app/public/' . $documento->url));
            }

            // Guardar el nuevo archivo
            $request->file('url')->storeAs($folderPath, $fileName, 'public');
            $documento->url = $fullPath;
        }

        // Actualizar el documento en la base de datos
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

        return redirect()->route('datos-generales.documentos.index')->with('success', 'Documento actualizado exitosamente.');
    }

    public function destroy(Documento $documento)
    {
        // Renombrar el archivo en lugar de eliminarlo
        if (file_exists(storage_path('app/public/' . $documento->url))) {
            $newPath = str_replace('.pdf', '_del.pdf', $documento->url);
            rename(storage_path('app/public/' . $documento->url), storage_path('app/public/' . $newPath));
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
