<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Directorios extends Model
{
    protected $fillable = [
    	'id_categoria', 
        'foto', 
        'cargo', 
        'nombre', 
        'apellidos', 
        'correo', 
        'telefono',     	
    ];
    public function categorias()
    {
        return $this->belongsTo(Categorias::class, 'id_categoria');
    }
}
