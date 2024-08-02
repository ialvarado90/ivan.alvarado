<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PedidosStoreRequest extends FormRequest
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
            'nro_pedido' => 'required',
            'producto_id' => 'required',
            'cantidad' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'nro_pedido.required' => 'El campo nro pedido es obligatorio.',
            'producto_id.required' => 'Debes proporcionar al menos un producto.',
            'cantidad.required' => 'El campo cantidad es obligatorio.',
        ];
    }
}
