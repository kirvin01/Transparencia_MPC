<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Documento extends Model
{
    use HasFactory;

    protected $table = 'documentos';

    protected $fillable = [
        'idtipo_documento',
        'numero',
        'fecha',
        'fechapubli',
        'sumilla',
        'url',
        'idestado',
        'html',
        'titulo',
    ];

    protected static function booted()
    {
        static::creating(function ($documento) {
            // Establecer fechapubli con la fecha actual del servidor si no se envía
            $documento->fechapubli = $documento->fechapubli ?? now();
            $documento->html = $documento->html ?? null;
        });

        static::deleting(function ($documento) {
            // Renombrar el archivo al eliminar el documento
            if (file_exists(storage_path('app/public/' . $documento->url))) {
                $newPath = str_replace('.pdf', '_del.pdf', $documento->url);
                rename(storage_path('app/public/' . $documento->url), storage_path('app/public/' . $newPath));
            }
        });
    }

    // Relaciones con otros modelos
    public function tipoDocumento()
    {
        return $this->belongsTo(TipoDocumento::class, 'idtipo_documento');
    }

    public function estado()
    {
        return $this->belongsTo(EstadoDocumento::class, 'idestado');
    }
}
