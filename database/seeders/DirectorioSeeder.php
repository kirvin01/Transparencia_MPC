<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Directorios;



class DirectorioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    
    public function run(): void
    {
        Directorios::factory()->count(100)->create();
        Directorios::create([
            'id_categoria' => 1, // ID de la categoría 'Administración'
            'foto' => null,
            'cargo' => 'Gerente General',
            'nombre' => 'Juan',
            'apellidos' => 'Pérez',
            'correo' => 'juan.perez@example.com',
            'telefono' => '123456789'
        ]);

        Directorios::create([
            'id_categoria' => 2, // ID de la categoría 'Finanzas'
            'foto' => null,
            'cargo' => 'Contador',
            'nombre' => 'María',
            'apellidos' => 'González',
            'correo' => 'maria.gonzalez@example.com',
            'telefono' => '987654321'
        ]);

        
    }
}
