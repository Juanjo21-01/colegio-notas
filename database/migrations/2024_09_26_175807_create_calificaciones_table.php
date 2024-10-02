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
        Schema::create('calificaciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('asignacion_grado_curso_id')->constrained('asignacion_grado_cursos');
            $table->foreignId('estudiante_id')->constrained('estudiantes');
            $table->decimal('nota', 8, 2);
            $table->enum('unidad', ['I', 'II', 'III', 'IV']);
            $table->boolean('estado')->default(1);
            $table->foreignId('user_id')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calificaciones');
    }
};
