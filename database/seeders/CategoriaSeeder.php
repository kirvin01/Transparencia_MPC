<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Categoria;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Categoria::create(['descripcion' => 'ALCALDÍA']);
        Categoria::create(['descripcion' => 'CONSEJO MUNICIPAL']);
        Categoria::create(['descripcion' => 'GERENCIA MUNICIPAL']);
        Categoria::create(['descripcion' => 'GERENCIAS']);
    }
}
