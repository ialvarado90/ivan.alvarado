<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PedidoChangeStateRequest extends FormRequest
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
            "estado_id" => 'required',
            'repartidor_id' => 'required_if:estado_id,3',
        ];
    }

    public function messages()
    {
        return [
            'estado_id.required' => 'Debe seleccionar estado.',
            'repartidor_id.required_if' => 'Debe indicar el repartidor a cargo.',
        ];
    }
}
