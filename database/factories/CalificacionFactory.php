<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Calificacion>
 */
class CalificacionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'asignacion_grado_curso_id' => fake()->numberBetween(1, 10),
            'estudiante_id' => fake()->numberBetween(1, 10),
            'nota' => fake()->randomFloat(2, 50, 100),
            'unidad' => fake()->randomElement(['I', 'II', 'III', 'IV']),
            'estado' => fake()->randomElement(['0', '1']),
            'user_id' => fake()->numberBetween(2, 11),
        ];
    }
}
