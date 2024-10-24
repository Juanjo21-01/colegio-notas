<?php

namespace App\Http\Requests\Estudiante;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEstudianteRequest extends FormRequest
{
    // Autorizar la petición
    public function authorize(): bool
    {
        return true;
    }

    // Reglas de validación
    public function rules(): array
    {
        $method = $this->method();

        if ($method === 'PUT') {
            return [
                'nombres' => 'required|string|min:2|max:50',
                'apellidos' => 'required|string|min:2|max:50',
                'fecha_nacimiento' => 'required|date',
                'codigo_personal' => 'required|string|max:10',
                'genero' => 'required|string|in:M,F',
            ];
        } else {
            return [
                'nombres' => 'sometimes|string|min:2|max:50',
                'apellidos' => 'sometimes|string|min:2|max:50',
                'fecha_nacimiento' => 'sometimes|date',
                'codigo_personal' => 'sometimes|string|max:10',
                'genero' => 'sometimes|string|in:M,F',
            ];
        }
    }
}
