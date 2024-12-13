<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoDocumento extends Model
{
    protected $table = 'tipo_documentos'; // Nombre de la tabla

    //protected $primaryKey = 'idtipo_documento'; // Clave primaria

    protected $fillable = [
        'titulo',
        'Abreviatura',
        'Carpeta',
        'permisos'
    ];
}
