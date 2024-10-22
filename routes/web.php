<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;



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
});

require __DIR__.'/auth.php';
