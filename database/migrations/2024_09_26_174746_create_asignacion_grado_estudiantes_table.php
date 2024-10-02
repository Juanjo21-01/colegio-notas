<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('asignacion_grado_estudiantes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('grado_id')->constrained('grados');
            $table->foreignId('estudiante_id')->constrained('estudiantes');
            $table->enum('estado', ['activo', 'inactivo'])->default('activo');
            $table->foreignId('user_id')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asignacion_grado_estudiantes');
    }
};
