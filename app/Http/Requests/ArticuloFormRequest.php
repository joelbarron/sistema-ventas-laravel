<?php

namespace sistemaVentasUsbix\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticuloFormRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            //
            'id_categoria' => 'required',
            'codigo' => 'required|max:50',
            'nombre' => 'required|max:100',
            'stock' => 'required|numeric',
            'precio_venta' => 'required',
            'descripcion' => 'max:512',
            'imagen' => 'mimes:jpeg,bmp,png'
        ];
    }
}
