<?php

namespace App\Http\Requests\Calificaciones;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCalificacionesRequest extends FormRequest
{
    // Autorizar la petición
    public function authorize(): bool
    {
        return true;
    }

    // Reglas de validación
    public function rules(): array
    {
        return [
            'grado_curso_id' => 'required|exists:asignacion_grado_cursos,id',
            'unidad' => 'required|string',
            'calificaciones' => 'required|array',
            'calificaciones.*.estudiante_id' => 'required|exists:asignacion_grado_estudiantes,estudiante_id',
            'calificaciones.*.nota' => 'required|numeric|min:0|max:100',
        ];
    }
}
