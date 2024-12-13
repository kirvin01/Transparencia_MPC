<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;


class MinStorageService
{
    /**
     * Subir un archivo al almacenamiento S3.
     *
     * @param \Illuminate\Http\UploadedFile $file
     * @param string $folder
     * @return array
     */
    public function uploadFile($file, $folder, $fileName)
    {
        try {
            // Validar que el archivo es válido
            if (!$file->isValid()) {
                throw new \Exception('El archivo no es válido.');
            }

            // Normalizar el nombre del archivo
            $fileName = preg_replace('/\s+/', '-', $fileName);
            $fileName = preg_replace('/[^A-Za-z0-9\-_.]/', '', $fileName);

            // Definir la carpeta de almacenamiento
            $folder = rtrim("transparencia/$folder", '/');
            $filePath = "$folder/$fileName";

            // Verificar si el archivo ya existe y generar un nombre único
            if (Storage::disk('s3')->exists($filePath)) {
                $timestamp = time();
                $extension = $file->getClientOriginalExtension();
                $fileName = pathinfo($fileName, PATHINFO_FILENAME) . "-$timestamp.$extension";
                $filePath = "$folder/$fileName";
            }

            // Subir el archivo al almacenamiento
            Storage::disk('s3')->put($filePath, file_get_contents($file));

            // Retornar los detalles del archivo subido
            return [
                'ruta' => $filePath,
                'url' => Storage::disk('s3')->url($filePath),
            ];
        } catch (\Exception $e) {
            // Lanza una excepción con un mensaje claro
            throw new \Exception('Error al subir el archivo: ' . $e->getMessage());
        }
    }
    public function deleteFile($filePath)
    {
        try {


            // Renombrar el archivo con un sufijo para evitar pérdida definitiva
            $extension = pathinfo($filePath, PATHINFO_EXTENSION);
            $fileName = pathinfo($filePath, PATHINFO_FILENAME);
            $folder = dirname($filePath);

            // Crear un nuevo nombre para el archivo eliminado
            $newFileName = $fileName . '_del.' . $extension;
            $newFilePath = "$folder/$newFileName";

            // Si el archivo renombrado ya existe, añade un timestamp para evitar conflictos
            if (Storage::disk('s3')->exists($newFilePath)) {
                $newFileName = $fileName . '_del_' . time() . '.' . $extension;
                $newFilePath = "$folder/$newFileName";
            }

            // Mover el archivo al nuevo nombre
            Storage::disk('s3')->move($filePath, $newFilePath);


            return [
                'error' => false,
                'message' => 'El archivo se elimino correctamente.',
                'url_antigua' => $filePath,
                'url_nueva' => $newFilePath,
            ];
        } catch (\Exception $e) {
            // Registrar cualquier error para depuración
            \Log::error('Error al eliminar el archivo: ' . $e->getMessage());

            return [
                'error' => true,
                'message' => 'Error al eliminar el archivo: ' . $e->getMessage(),
            ];
        }
    }


    public function fileExists($filePath)
    {
        return Storage::disk('s3')->exists($filePath);
    }

    public function getUrl($filePath)
    {
        $server = config('filesystems.disks.s3.url', env('AWS_URL'));

        if (empty($server)) {
            throw new \Exception('El servidor S3 no está configurado. Verifica el archivo .env o config/filesystems.php');
        }
        if (empty($filePath) || trim($filePath) === '') {
            throw new \Exception('La ruta del archivo no puede estar vacía.');
        }

        return rtrim($server, '/') . '/' . ltrim($filePath, '/');
    }
}
