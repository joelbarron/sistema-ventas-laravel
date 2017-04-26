<?php

namespace sistemaVentasUsbix;

use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    //
    protected $table = 'articulos';
    
    protected $primaryKey= 'id_articulo';

    public $timestamps = false;

    protected $fillable = [
    	'id_categoria',
    	'codigo',
    	'nombre',
    	'stock',
        'precio_venta',
    	'descripcion',
    	'imagen',
    	'estado'
    ];

    protected $guarded = [

    	
    ];
}
