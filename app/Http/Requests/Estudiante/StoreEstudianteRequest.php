<?php

namespace App\Http\Requests\Estudiante;

use Illuminate\Foundation\Http\FormRequest;

class StoreEstudianteRequest extends FormRequest
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
            'nombres' => 'required|string|min:2|max:50',
            'apellidos' => 'required|string|min:2|max:50',
            'fecha_nacimiento' => 'required|date',
            'codigo_personal' => 'required|string|max:10|unique:estudiantes,codigo_personal',
            'genero' => 'required|string|in:M,F',
        ];
    }
}
