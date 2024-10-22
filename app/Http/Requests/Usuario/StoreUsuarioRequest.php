<?php

namespace App\Http\Requests\Usuario;

use Illuminate\Foundation\Http\FormRequest;

class StoreUsuarioRequest extends FormRequest
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
            'nombres' => 'required|string|max:50',
            'apellidos' => 'required|string|max:50',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|max:255',
            'dpi' => 'required|string|max:13|unique:users,dpi',
            'telefono' => 'required|string|max:8',
            'role_id' => 'required|integer|exists:roles,id',
        ];
    }
}
