<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Grado;

class GradosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear los grados
        $grados = ['Primero', 'Segundo', 'Tercero'];
        $seccion = ['A', 'B', 'C'];

        foreach ($grados as $grado) {
            foreach ($seccion as $sec) {
                Grado::create([
                    'nombre' => $grado,
                    'seccion' => $sec,
                ]);
            }
        }
    }
}
