<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Estudiante;
use App\Models\Grado;
use App\Models\AsignacionGradoEstudiante;
use App\Models\Curso;
use App\Models\AsignacionGradoCurso;
use App\Models\Calificacion;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Roles
        $this->call(RoleSeeder::class);

        // Usuarios
        $this->call(UserAdminSeeder::class);
        User::factory(10)->create();

        // Estudiantes
        Estudiante::factory(10)->create();

        // Grados
        $this->call(GradosSeeder::class);

        // Asignacion de grados a estudiantes
        AsignacionGradoEstudiante::factory(10)->create();

        // Cursos
        Curso::factory(10)->create();

        // Asignacion de cursos a grados
        AsignacionGradoCurso::factory(10)->create();

        // Calificaciones
        Calificacion::factory(10)->create();
    }
}
