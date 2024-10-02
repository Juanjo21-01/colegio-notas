<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Estudiante>
 */
class EstudianteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombres' => fake()->firstName(),
            'apellidos' => fake()->lastName(),
            'fecha_nacimiento' => fake()->dateTimeBetween('-17 years', '-12 years')->format('Y-m-d'),
            'codigo_personal' => fake()->unique()->numerify('#########'),
            'genero' => fake()->randomElement(['M', 'F']),
            'estado' => fake()->randomElement(['estudiando', 'retirado', 'graduado', 'repitiendo']),
            'user_id' => 2,
        ];
    }
}
