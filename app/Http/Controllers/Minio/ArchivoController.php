<?php

namespace App\Http\Controllers\Minio;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/*clases*/
use App\Services\MinStorageService;

class ArchivoController extends Controller
{
    protected $minStorage;

    public function __construct(MinStorageService $minStorage)
    {
        $this->minStorage = $minStorage;
    }
    public function subirArchivo(Request $request)
    {
        $request->validate([
            'archivo' => 'required|file|max:102400', // Máximo 100 MB
        ]);

        try {
            $file = $request->file('archivo');
            $folder = 'demo';

            // Llama al servicio para subir el archivo
            $resultado = $this->minStorage->uploadFile($file, $folder,'demo 1.pdf');

            // Devuelve una respuesta JSON
            return response()->json([
                'mensaje' => 'Archivo subido exitosamente.', 
                'datos' => $resultado,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'mensaje' => 'Error al subir el archivo.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    /**
     * Subir un archivo a MinIO.
     */
    public function subirArchivo2(Request $request)
    {
        $request->validate([
            'archivo' => 'required|file|max:10240', // Máximo 10 MB
        ]);

        try {
            // Obtener el archivo desde el formulario
            $archivo = $request->file('archivo');

            // Obtener el nombre original del archivo
            $nombreOriginal = $archivo->getClientOriginalName();

            // Subir el archivo conservando el nombre original
            $ruta = Storage::disk('s3')->putFileAs(
                'transparencia', // Carpeta dentro del bucket uploads
                $archivo,
                $nombreOriginal // Nombre original del archivo
            );

            return response()->json([
                'mensaje' => 'Archivo subido exitosamente.',
                'ruta' => $ruta,
                'url' => Storage::disk('s3')->url($ruta),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'mensaje' => 'Error al subir el archivo.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }


    /**
     * Modificar el nombre de un archivo en MinIO.
     */
    public function modificarNombre(Request $request)
    {
        $request->validate([
            'ruta' => 'required|string',
            'nuevo_nombre' => 'required|string',
        ]);

        try {
            $rutaActual = $request->input('ruta');
            $nuevoNombre = $request->input('nuevo_nombre');

            $extension = pathinfo($rutaActual, PATHINFO_EXTENSION);
            $nuevaRuta = 'uploads/' . $nuevoNombre . '.' . $extension;

            if (!Storage::disk('s3')->exists($rutaActual)) {
                return response()->json([
                    'mensaje' => 'El archivo especificado no existe.',
                ], 404);
            }

            Storage::disk('s3')->move($rutaActual, $nuevaRuta);

            return response()->json([
                'mensaje' => 'Nombre del archivo modificado exitosamente.',
                'nueva_ruta' => $nuevaRuta,
                'url' => Storage::disk('s3')->url($nuevaRuta),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'mensaje' => 'Error al modificar el nombre del archivo.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Obtener la URL de un archivo almacenado en MinIO.
     */
    public function obtenerRuta(Request $request)
    {
        $request->validate([
            'ruta' => 'required|string',
        ]);

        try {
            $ruta = $request->input('ruta');

            if (!Storage::disk('s3')->exists($ruta)) {
                return response()->json([
                    'mensaje' => 'El archivo no existe.',
                ], 404);
            }

            return response()->json([
                'mensaje' => 'Ruta obtenida exitosamente.',
                'url' => Storage::disk('s3')->url($ruta),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'mensaje' => 'Error al obtener la ruta del archivo.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Eliminar un archivo de MinIO.
     */
    public function eliminarArchivo(Request $request)
    {
        $request->validate([
            'ruta' => 'required|string',
        ]);

        try {
            $ruta = $request->input('ruta');

            if (!Storage::disk('s3')->exists($ruta)) {
                return response()->json([
                    'mensaje' => 'El archivo no existe.',
                ], 404);
            }

            Storage::disk('s3')->delete($ruta);

            return response()->json([
                'mensaje' => 'Archivo eliminado exitosamente.',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'mensaje' => 'Error al eliminar el archivo.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    /**
     * Listar los archivos en el bucket de MinIO con sus URLs públicas.
     */
    public function listarArchivos()
    {
        try {
            // Obtiene la lista de archivos en la carpeta 'uploads'
            $archivos = Storage::disk('s3')->files('transparencia/PARTICIPACION CIUDADANA/AUDIENCIAS-PÚBLICAS');

            // Si no hay archivos, devuelve un mensaje vacío
            if (empty($archivos)) {
                return response()->json([
                    'mensaje' => 'No se encontraron archivos.',
                    'archivos' => [],
                ]);
            }

            // Devuelve la lista de archivos con sus URLs públicas
            $archivosConUrls = array_map(function ($archivo) {
                $disk = Storage::disk('s3');


                $url = Storage::disk('s3')->url($archivo);
                //print($archivo);

                return [
                    'nombre' => basename($archivo), // Nombre del archivo
                    'ruta' => $archivo,            // Ruta relativa en el bucket                    
                    'url' => $url,
                ];
            }, $archivos);

            return response()->json([
                'mensaje' => 'Archivos listados exitosamente.',
                'archivos' => $archivosConUrls,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'mensaje' => 'Error al listar los archivos.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
