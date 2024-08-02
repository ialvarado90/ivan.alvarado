<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'cod' => 'required',
            'nombre' => 'required',
            'email' => 'required|email',
            'telefono' => 'required',
            'puesto' => 'required',
            'rol_id' => 'required',
            'password' => 'required|string|min:8',
        ];
    }

    public function messages()
    {
        return [
            'cod.required' => 'El código trabajador es obligatorio.',
            'nombre.required' => 'El campo nombre es obligatorio.',
            'telefono.required' => 'El campo teléfono es obligatorio.',
            'puesto.required' => 'El campo puesto es obligatorio.',
            'rol_id.required' => 'Debe seleccionar rol.',
            'email.required' => 'El campo email es obligatorio.',
            'email.email' => 'Ingrese email válido.',
            'password.required' => 'El campo password es obligatorio.',
            'password.min' => 'El password debe tener mínimo 8 caracteres.',
        ];
    }
}
