<?php

namespace sistemaVentasUsbix;

use Illuminate\Database\Eloquent\Model;

class Ingreso extends Model
{
    //
    protected $table = 'ingresos';
    
    protected $primaryKey= 'id_ingreso';

    public $timestamps = false;

    protected $fillable = [
    	'id_proveedor',
    	'tipo_comprobante',
    	'serie_comprobante',
    	'num_comprobante',
    	'fecha_hora',
    	'impuesto',
    	'estado'
    ];

    protected $guarded = [

    	
    ];

}
