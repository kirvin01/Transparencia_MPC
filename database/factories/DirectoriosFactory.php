<?php

namespace Database\Factories;

use App\Models\Directorios;
use App\Models\Categoria;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Directorio>
 */
class DirectoriosFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_categoria' =>  rand(1, 4), //Categoria::factory(), // Genera una categoría relacionada
            'foto' =>null,// $this->faker->imageUrl(640, 480, 'people'),
            'cargo' => $this->faker->jobTitle(),
            'nombre' => $this->faker->firstName(),
            'apellidos' => $this->faker->lastName(),
            'correo' => $this->faker->unique()->safeEmail(),
            'telefono' => $this->faker->phoneNumber(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
