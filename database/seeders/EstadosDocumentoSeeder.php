<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class EstadosDocumentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $estado_documento = [
            [
                'descripcion' => 'NUEVO'
            ],
            [
                'descripcion' => 'VIGENTE'
            ],
            [
                'descripcion' => 'DEROGADA'
            ],
            [
                'descripcion' => 'NUEVO'
            ],
            [
                'descripcion' => 'OBSOLETO'
            ],
        ];
        DB::table('estados_documento')->insert( $estado_documento);
    }
}
