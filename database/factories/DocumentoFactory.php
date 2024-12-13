<?php

namespace Database\Factories;

use App\Models\TipoDocumento;
use App\Models\EstadoDocumento;
use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Documento>
 */
class DocumentoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $tipoDocumento = TipoDocumento::inRandomOrder()->first() ?? TipoDocumento::factory()->create();
        $numero = $this->faker->unique()->numerify('###');
        $fecha = $this->faker->date('Y-m-d');
        
        return [
            'idtipo_documento' => $tipoDocumento->id,
            'numero' => $numero,
            'fecha' => $fecha,
            'fechapubli' => $this->faker->dateTime(),
            'sumilla' => $this->faker->text(800),
            'url' => $this->faker->url,
            'idestado' => EstadoDocumento::inRandomOrder()->first()?->id ?? EstadoDocumento::factory()->create()->id,
            'html' => '<p>' . $this->faker->paragraph . '</p>',
            'titulo' => $tipoDocumento->titulo . " N° " . $numero . '-' . date('Y', strtotime($fecha)),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
    
}
