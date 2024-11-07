<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GradoController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\AsignacionGradoCursoController;
use App\Http\Controllers\EstudianteController;
use App\Http\Controllers\AsignacionGradoEstudianteController;
use App\Http\Controllers\CalificacionController;
use App\Http\Controllers\PDFController;

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Roles
    Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
    // Usuarios
    Route::resource('usuarios', UserController::class)->names('usuarios');
    Route::get('usuarios/cambiar-estado/{id}', [UserController::class, 'cambiarEstado'])->name('usuarios.cambiar-estado');
    // Grados
    Route::get('grados', [GradoController::class, 'index'])->name('grados.index');
    Route::get('grados/cambiar-estado/{id}', [GradoController::class, 'cambiarEstado'])->name('grados.cambiar-estado');
    // Cursos
    Route::resource('cursos', CursoController::class)->names('cursos');
    Route::get('cursos/cambiar-estado/{id}', [CursoController::class, 'cambiarEstado'])->name('cursos.cambiar-estado');
    // Asignaciones grados y cursos
    Route::resource('grados-cursos', AsignacionGradoCursoController::class)->names('grados-cursos');
    Route::get('grados-cursos/cambiar-estado/{id}', [AsignacionGradoCursoController::class, 'cambiarEstado'])->name('grados-cursos.cambiar-estado');
    // Estudiantes
    Route::resource('estudiantes', EstudianteController::class)->names('estudiantes');
    Route::get('estudiantes/cambiar-estado/{id}', [EstudianteController::class, 'cambiarEstado'])->name('estudiantes.cambiar-estado');
    // Asignaciones grados y estudiantes
    Route::resource('grados-estudiantes', AsignacionGradoEstudianteController::class)->names('grados-estudiantes');
    Route::get('grados-estudiantes/cambiar-estado/{id}', [AsignacionGradoEstudianteController::class, 'cambiarEstado'])->name('grados-estudiantes.cambiar-estado');
    // Calificaciones
    Route::resource('calificaciones/cursos', CalificacionController::class)->names('calificaciones.cursos');
    Route::get('calificaciones/cursos/cambiar-estado/{id}', [CalificacionController::class, 'cambiarEstado'])->name('calificaciones.cursos.cambiar-estado');
    // Calificaciones por estudiantes
    Route::get('calificaciones/estudiantes', [CalificacionController::class, 'inicioEstudiantes'])->name('calificaciones.estudiantes');
    Route::get('calificaciones/estudiantes/{id}', [CalificacionController::class, 'notasEstudiantes'])->name('calificaciones.estudiantes.notas');
    Route::get('calificaciones/estudiantes/{idGrado}/notas/{idEstudiante}', [CalificacionController::class, 'notaEstudiante'])->name('calificaciones.estudiantes.notas.show');
    // PDF
    Route::get('calificaciones/pdf/curso/{id}', [PDFController::class, 'calificacionesPorCurso'])->name('calificaciones.pdf.curso');
    Route::get('calificaciones/pdf/grado/{id}', [PDFController::class, 'calificacionesPorGrado'])->name('calificaciones.pdf.grado');
    Route::get('calificaciones/pdf/{idGrado}/estudiante/{idEstudiante}', [PDFController::class, 'calificacionesPorEstudiante'])->name('calificaciones.pdf.estudiante');
});

require __DIR__.'/auth.php';
