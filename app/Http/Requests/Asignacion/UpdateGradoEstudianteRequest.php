<?php

namespace App\Http\Requests\Asignacion;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGradoEstudianteRequest extends FormRequest
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
            'grado_id' => 'required|exists:grados,id',
            'estudiante_id' => 'required|exists:estudiantes,id',
        ];
    }
}
