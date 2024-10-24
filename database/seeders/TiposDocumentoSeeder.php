<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TipoDocumento;
use Illuminate\Support\Facades\DB;

class TiposDocumentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tipos_documento = [
            [
                'titulo' => 'Ordenanza Regional',
                'Abreviatura' => 'OR.',
                'Carpeta' => 'ordenanzas',
                'permisos' => 'do-Ordenanza-Regional'
            ],
            [
                'titulo' => 'Resolución Ejecutiva Regional',
                'Abreviatura' => 'RER.',
                'Carpeta' => 'resoluciones',
                'permisos' => 'do-Resolución-Ejecutiva-Regional'
            ],
            [
                'titulo' => 'Convenio',
                'Abreviatura' => 'CONV.',
                'Carpeta' => 'convenios',
                'permisos' => 'do-Convenio'
            ],
            [
                'titulo' => 'Acuerdo De Consejo Regional',
                'Abreviatura' => 'AR.',
                'Carpeta' => 'acuerdos',
                'permisos' => 'do-Acuerdo-De-Consejo-Regional'
            ],
            [
                'titulo' => 'Decreto Regional',
                'Abreviatura' => 'DR.',
                'Carpeta' => 'decretos',
                'permisos' => 'do-Decreto-Regional'
            ],
            [
                'titulo' => 'Directiva',
                'Abreviatura' => 'DIR.',
                'Carpeta' => 'directivas',
                'permisos' => 'do-Directiva'
            ],
            [
                'titulo' => 'Resolución Gerencial General Regional',
                'Abreviatura' => 'RGG.',
                'Carpeta' => 'rgg',
                'permisos' => 'do-Resolución-Gerencial-General-Regional'
            ],
            [
                'titulo' => 'Resolución Gerencial Regional de Administración',
                'Abreviatura' => 'RGA.',
                'Carpeta' => 'rd-administracion',
                'permisos' => 'do-Resolución-Gerencial-Regional-de-Administración'
            ],
            [
                'titulo' => 'Resolución de Gestión de Inversiones de Infraestructura',
                'Abreviatura' => 'RGGP.',
                'Carpeta' => 'RGR-GRI',
                'permisos' => 'do-Resolución-de-Gestión-de-Inversiones-de-Infraestructura'
            ],
            [
                'titulo' => 'Adenda',
                'Abreviatura' => 'ADD.',
                'Carpeta' => 'addenda',
                'permisos' => 'do-Adenda'
            ],
            [
                'titulo' => 'Resolución Gerencial Regional de Planeamiento, Presupuesto y Modernización',
                'Abreviatura' => 'RGPPM.',
                'Carpeta' => 'GRPPAT',
                'permisos' => 'do-Resolución-Gerencial-Regional-de-Planeamiento-Presupuesto-Modernización'
            ],
            [
                'titulo' => 'Resolución Gerencial Regional de Desarrollo Económico',
                'Abreviatura' => 'RGDE.',
                'Carpeta' => 'GRDE',
                'permisos' => 'do-Resolución-Gerencial-Regional-de-Desarrollo-Económico'
            ],
            [
                'titulo' => 'Resolución de Gerencia Regional de Inclusión Social, Mujer y Poblaciones vulnerables',
                'Abreviatura' => 'RGDS.',
                'Carpeta' => 'GRDS',
                'permisos' => 'do-Resolución-de-Gerencia-Regional-de-Inclusión-Social-Mujer-y-Poblaciones-vulnerables'
            ],
            [
                'titulo' => 'Resolución Gerencial Regional de Recursos Naturales y Gestión Ambiental',
                'Abreviatura' => 'RGRNMA.',
                'Carpeta' => 'RGRNMA',
                'permisos' => 'do-Resolución-Gerencial-Regional-de-Recursos-Naturales-y-Gestión-Ambiental'
            ],
            [
                'titulo' => 'Resolución Gerencial Regional de Vivienda Construcción y Saneamiento',
                'Abreviatura' => 'RGVCS.',
                'Carpeta' => 'RGVCS',
                'permisos' => 'do-Resolución-Gerencial-Regional-de-Vivienda-Construcción-y-Saneamiento'
            ],
            [
                'titulo' => 'Resolución Gerencial Regional de Supervisión y Liquidación de Inversiones',
                'Abreviatura' => 'GRSLI.',
                'Carpeta' => 'GRSLI',
                'permisos' => 'do-Resolución-Gerencial-Regional-de-Supervisión-y-Liquidación-de-Inversiones'
            ],
            [
                'titulo' => 'Resolución Subgerencia de Gestión de Recursos Humanos',
                'Abreviatura' => 'RSGRH.',
                'Carpeta' => 'RSGRH',
                'permisos' => 'do-Resolución-Subgerencia-de-Gestión-de-Recursos-Humanos'
            ],
            [
                'titulo' => 'Contratos Obras por Impuesto',
                'Abreviatura' => 'COI.',
                'Carpeta' => 'COI',
                'permisos' => 'do-Contratos-Obras-por-Impuesto'
            ],
            [
                'titulo' => 'Convenio y adendas de inversión - OXI',
                'Abreviatura' => 'CONVI.',
                'Carpeta' => 'conv-inversion',
                'permisos' => 'do-Convenio-y-adendas-de-inversión-OXI'
            ],
            [
                'titulo' => 'Acta de trato directo',
                'Abreviatura' => 'ATD.',
                'Carpeta' => 'acta-trato',
                'permisos' => 'do-Acta-de-trato-directo'
            ],
            [
                'titulo' => 'Otros convenios',
                'Abreviatura' => 'CM.',
                'Carpeta' => 'conveniomarco',
                'permisos' => 'do-Otros-convenios'
            ],
            [
                'titulo' => 'demoprueba',
                'Abreviatura' => 'DM.',
                'Carpeta' => 'demoprueba',
                'permisos' => 'do-demoprueba'
            ],
            [
                'titulo' => 'Convenios IMA',
                'Abreviatura' => 'CIMA.',
                'Carpeta' => 'CONVENIOIMA',
                'permisos' => 'do-Convenios-IMA'
            ],
            [
                'titulo' => 'Acuerdos de Hermanamiento',
                'Abreviatura' => 'AH.',
                'Carpeta' => 'AcuerdoHermanamiento',
                'permisos' => 'do-Acuerdos-de-Hermanamiento'
            ],
            [
                'titulo' => 'Gerencia Regional de Agricultura',
                'Abreviatura' => 'GERAGRI.',
                'Carpeta' => 'GERAGRI',
                'permisos' => 'do-Gerencia-Regional-Agricultura'
            ]
        ];
        DB::table('tipos_documento')->insert($tipos_documento);
    }
}
