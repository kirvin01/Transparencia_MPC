<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EstadoDocumento extends Model
{
    protected $table = 'estados_documento';     

    protected $fillable = [
    	'descripcion',     	
    ];
}
