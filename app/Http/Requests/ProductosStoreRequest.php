<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductosStoreRequest extends FormRequest
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
            'nombre' => 'required',
            'sku' => 'required',
            'tipo' => 'required',
            'tags' => 'required',
            'price' => 'required',
            'unidad' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'sku.required' => 'El campo sku es obligatorio.',
            'tipo.required' => 'El campo tipo es obligatorio.',
            'tags.required' => 'Debe indicar tags.',
            'price.required' => 'El campo price es obligatorio.',
            'unidad.required' => 'El campo unidad es obligatorio.',
        ];
    }
}
