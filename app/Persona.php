<?php

namespace sistemaVentasUsbix;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    //
    protected $table = 'personas';
    
    protected $primaryKey= 'id_persona';

    public $timestamps = false;

    protected $fillable = [
    	'tipo_persona',
    	'nombre',
    	'a_pateno',
    	'a_materno',
    	'tipo_documento',
    	'num_documento',
    	'direccion',
    	'telefono',
    	'email'
    ];

    protected $guarded = [

    	
    ];
}
