<?php

namespace sistemaVentasUsbix\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IngresoFormRequest extends FormRequest
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

            //para el ingreso
            'id_proveedor' => 'required',
            'tipo_comprobante' => 'required|max:20',
            'serie_comprobante' => 'max:7',
            'num_comprobante' => 'required|max:10',

            //para el detalle de ingreso
            'id_articulo' => 'required',
            'cantidad' => 'required',
            'precio_compra' => 'required'            
            
        ];
    }
}
