<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GradoController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\AsignacionGradoCursoController;
use App\Http\Controllers\EstudianteController;

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
    Route::get('grados-cursos', [AsignacionGradoCursoController::class, 'index'])->name('grados-cursos.index');
    Route::get('grados-cursos/cambiar-estado/{id}', [AsignacionGradoCursoController::class, 'cambiarEstado'])->name('grados-cursos.cambiar-estado');
    // Estudiantes
    Route::resource('estudiantes', EstudianteController::class)->names('estudiantes');
    Route::get('estudiantes/cambiar-estado/{id}', [EstudianteController::class, 'cambiarEstado'])->name('estudiantes.cambiar-estado');
});

require __DIR__.'/auth.php';
