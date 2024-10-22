<?php

namespace App\Http\Requests\Usuario;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUsuarioRequest extends FormRequest
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
            // Encriptamos la contraseña
            $this->merge([
                'password' => bcrypt($this->password),
            ]);
            return [
                'nombres' => ['required', 'string', 'max:50'],
                'apellidos' => ['required', 'string', 'max:50'],
                'email' => ['required', 'string', 'email', 'max:255'],
                'dpi' => ['required', 'string', 'max:13'],
                'telefono' => ['required', 'string', 'max:8'],
                'password' => ['required', 'string', 'max:255'],
                'role_id' => ['required', 'integer', 'exists:roles,id'],
            ];
        } else {
            if ($this->filled('password') === null) {
                return [
                    'nombres' => ['sometimes', 'string', 'max:50'],
                    'apellidos' => ['sometimes', 'string', 'max:50'],
                    'email' => ['sometimes', 'string', 'email', 'max:255'],
                    'dpi' => ['sometimes', 'string', 'max:13'],
                    'telefono' => ['sometimes', 'string', 'max:8'],
                    'role_id' => ['sometimes', 'integer', 'exists:roles,id'],
                ];
            } else {
                // ENCRIPTAR CONTRASEÑA
                $this->merge([
                    'password' => bcrypt($this->password),
                ]);
                return [
                    'nombres' => ['sometimes', 'string', 'max:50'],
                    'apellidos' => ['sometimes', 'string', 'max:50'],
                    'email' => ['sometimes', 'string', 'email', 'max:255'],
                    'dpi' => ['sometimes', 'string', 'max:13'],
                    'telefono' => ['sometimes', 'string', 'max:8'],
                    'password' => ['sometimes', 'string', 'max:255'],
                    'role_id' => ['sometimes', 'integer', 'exists:roles,id'],
                ];
            }
        }
    }
}
