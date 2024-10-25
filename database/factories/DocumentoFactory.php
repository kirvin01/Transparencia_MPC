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
        return [
            'idtipo_documento' => TipoDocumento::inRandomOrder()->first()->id ?? TipoDocumento::factory(),
            'numero' => $this->faker->unique()->numerify('DOC###'),
            'fecha' => $this->faker->date(),
            'fechapubli' => $this->faker->dateTime(),
            'sumilla' => $this->faker->text(800),
            'url' => $this->faker->url,
            'idestado' => EstadoDocumento::inRandomOrder()->first()->id ?? EstadoDocumento::factory(),
            'html' => '<p>' . $this->faker->paragraph . '</p>',
            'titulo' => $this->faker->sentence,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
    
}
