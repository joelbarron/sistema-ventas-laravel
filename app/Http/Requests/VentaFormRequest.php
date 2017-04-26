<?php

namespace sistemaVentasUsbix\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VentaFormRequest extends FormRequest
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

            //para la venta
            'id_cliente' => 'required',
            'tipo_comprobante' => 'required|max:20',
            'serie_comprobante' => 'max:7',
            'num_comprobante' => 'required|max:10',
            'total_venta' => 'required',

            //para el detalle de la venta
            'id_articulo' => 'required',
            'cantidad' => 'required',
            'precio_venta' => 'required',
            'descuento' => 'required'

        ];
    }
}
