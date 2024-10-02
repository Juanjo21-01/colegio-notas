<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AsignacionGradoCurso>
 */
class AsignacionGradoCursoFactory extends Factory
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
            'curso_id' => fake()->numberBetween(1, 10),
            'estado' => fake()->randomElement(['activo', 'inactivo']),
            'user_id' => fake()->numberBetween(2, 11),
        ];
    }
}
