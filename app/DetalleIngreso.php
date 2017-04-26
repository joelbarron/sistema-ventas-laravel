<?php

namespace sistemaVentasUsbix;

use Illuminate\Database\Eloquent\Model;

class DetalleIngreso extends Model
{
    //
    protected $table = 'detalles_ingresos';
    
    protected $primaryKey= 'id_detalle_ingreso';

    public $timestamps = false;

    protected $fillable = [
    	'id_ingreso',
    	'id_articulo',
    	'cantidad',
    	'precio_compra'      	
    ];

    protected $guarded = [

    	
    ];

}
