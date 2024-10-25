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

    // Si tienes relaciones con otros modelos, defínelas aquí

    public function tipoDocumento()
    {
        return $this->belongsTo(TipoDocumento::class, 'idtipo_documento');
    }

    public function estado()
    {
        return $this->belongsTo(EstadoDocumento::class, 'idestado');
    }
}
