<?php

namespace sistemaVentasUsbix;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
     //
    protected $table = 'ventas';
    
    protected $primaryKey= 'id_venta';

    public $timestamps = false;

    protected $fillable = [
    	'id_cliente',
    	'tipo_comprobante',
    	'serie_comprobante',
    	'num_comprobante',
    	'fecha_hora',
    	'impuesto',
    	'total_venta',
    	'estado'
    ];

    protected $guarded = [

    	
    ];
}
