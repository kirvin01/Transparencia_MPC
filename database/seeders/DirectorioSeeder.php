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

        $numRegistros = 100;

        for ($i = 1; $i <= $numRegistros; $i++) {
            Directorios::create([
                'id_categoria' => rand(1, 4), // Suponiendo que tienes 5 categorías
                'foto' => 'ruta/a/tu/foto' . $i . '.jpg', // Cambia esto por la lógica para tus fotos
                'cargo' => 'Cargo ' . $i,
                'nombre' => 'Nombre ' . $i,
                'apellidos' => 'Apellido ' . $i,
                'correo' => 'correo' . $i . '@ejemplo.com',
                'telefono' => '123456789' . $i,
            ]);
        }
    }
}
