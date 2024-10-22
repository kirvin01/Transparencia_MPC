<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Categorias;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Categorias::create(['descripcion' => 'ALCALDÍA']);
        Categorias::create(['descripcion' => 'CONSEJO MUNICIPAL']);
        Categorias::create(['descripcion' => 'GERENCIA MUNICIPAL']);
        Categorias::create(['descripcion' => 'GERENCIAS']);
    }
}
