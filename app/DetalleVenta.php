<?php

namespace sistemaVentasUsbix;

use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{
    //
    protected $table = 'detalles_ventas';
    
    protected $primaryKey= 'id_detalle_venta';

    public $timestamps = false;

    protected $fillable = [
    	'id_venta',
    	'id_articulo',
    	'cantidad',    	
    	'precio_venta',
    	'descuento'    	
    ];

    protected $guarded = [

    	
    ];

}
