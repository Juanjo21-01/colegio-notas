<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AsignacionGradoEstudiante>
 */
class AsignacionGradoEstudianteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'grado_id' => fake()->numberBetween(1, 9),
            'estudiante_id' => fake()->numberBetween(1, 10),
            'estado' => fake()->randomElement(['activo', 'inactivo']),
            'user_id' => 2,
        ];
    }
}
