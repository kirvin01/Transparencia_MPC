<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Directorios extends Model
{
    use HasFactory;

    protected $table = 'directorios';

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
        return $this->belongsTo(Categoria::class, 'id_categoria');
    }
}
