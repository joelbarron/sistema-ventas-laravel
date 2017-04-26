<?php

namespace sistemaVentasUsbix\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use sistemaVentasUsbix\Http\Requests\IngresoFormRequest;
use sistemaVentasUsbix\Ingreso;
use sistemaVentasUsbix\DetalleIngreso;
use DB;
use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;

class IngresoController extends Controller
{    
    //contructor
    public function __construct()
    {
        $this -> middleware('auth');
    }

    //index 
    public function index(Request $request)
    {
      if($request)
      {
        //almacenar la busqueda 
        $querry =  trim ($request -> get('searchText'));
        //obtener las categorias
        $ingresos = DB::table('ingresos as i') 
        -> join('personas as p','i.id_proveedor','=','p.id_persona')
        -> join('detalles_ingresos as di','i.id_ingreso','=','di.id_ingreso')
        -> select('i.id_ingreso', 'i.fecha_hora', 'p.nombre', 'p.a_paterno', 'i.tipo_comprobante', 'i.serie_comprobante', 'i.num_comprobante', 'i.impuesto', 'i.estado', DB::raw('sum(di.cantidad*precio_compra) as total'))
        -> where('i.num_comprobante','LIKE','%'.$querry.'%')         
        -> orderBy('i.id_ingreso', 'asc')
        -> groupBy('i.id_ingreso', 'i.fecha_hora', 'p.nombre', 'p.a_paterno', 'i.tipo_comprobante', 'i.serie_comprobante', 'i.num_comprobante', 'i.impuesto', 'i.estado')
        -> paginate(7);
        
        return view('compras.ingreso.index', ["ingresos" => $ingresos, "searchText" => $querry]);
      }
    }

    //create (mostra la vista de crear)
    public function create()
    {
      $personas = DB::table('personas') -> where('tipo_persona', '=', 'Proveedor') -> get();
      $articulos = DB::table('articulos as art')
      -> select(DB::raw('CONCAT (art.codigo, " - " ,art.nombre) as  articulo'), 'art.id_articulo')
      -> where ('art.estado', '=', 'Activo')
      -> get();

      return view('compras.ingreso.create', ['personas' => $personas, 'articulos' => $articulos]);
    }

    // //show (mostrar la vista de show)
    // public function show($id)
    // {
    //   return view ('compras.proveedor.show', ['persona' => Persona::findOrFail($id)]);
    // }

    // //edit (mostrar la vista de editar)
    // public function edit($id)
    // {
    //   return view ('compras.proveedor.edit', ['persona' => Persona::findOrFail($id)]);
    // }

    //store(insertar un registro)
    public function store(IngresoFormRequest $request)
    {
      
    try {

    	DB::beginTransaction();

		$ingreso = new Ingreso;	    
	    $ingreso -> id_proveedor = $request -> get('id_proveedor');//este valor es el que se encuentra en el formulario
	    $ingreso -> tipo_comprobante = $request -> get('tipo_comprobante');
	    $ingreso -> serie_comprobante = $request -> get('serie_comprobante');
	    $ingreso -> num_comprobante = $request -> get('num_comprobante');
	    $mytime = Carbon::now('America/Mexico_City');
	    $ingreso -> fecha_hora = $mytime -> toDateTimeString();
	    $ingreso -> impuesto = '16';
	    $ingreso -> estado = 'Aceptado';	    
	    $ingreso -> save();

	    $id_articulo  = $request -> get('id_articulo');
	    $cantidad = $request -> get('cantidad');
	    $precio_compra = $request -> get('precio_compra');

	    $cont=0;

	    while($cont < count ($id_articulo)){

	    	$detalle = new DetalleIngreso();
	    	$detalle -> id_ingreso = $ingreso -> id_ingreso;
	    	$detalle -> id_articulo = $id_articulo[$cont];
	    	$detalle -> cantidad = $cantidad[$cont];
	    	$detalle -> precio_compra = $precio_compra[$cont];
	    	$detalle -> save();
	    	
	    	$cont = $cont+1;
	    }

    	DB::commit();

    } catch (\Exception $e) {
    	DB::rollback();
    }

      return Redirect::to('compras/ingreso');
    }

    //show
    public function show ($id){

    	$ingreso = DB::table('ingresos as i') 
        -> join('personas as p','i.id_proveedor','=','p.id_persona')
        -> join('detalles_ingresos as di','i.id_ingreso','=','di.id_ingreso')
        -> select('i.id_ingreso', 'i.fecha_hora', 'p.nombre', 'p.a_paterno', 'i.tipo_comprobante', 'i.serie_comprobante', 'i.num_comprobante', 'i.impuesto', 'i.estado', DB::raw('sum(di.cantidad*precio_compra) as total'))
        -> where ('i.id_ingreso','=', $id)
        -> first();


        $detalles = DB::table('detalles_ingresos as d') 
         -> join('articulos as a','d.id_articulo','=','a.id_articulo')
         -> select('a.nombre as articulo', 'd.cantidad', 'd.precio_compra')
         -> where ('d.id_ingreso', '=', $id) -> get();

         return view('compras.ingreso.show', ['ingreso' => $ingreso, 'detalles' => $detalles]);
    }

    //update (actualizar un registro)
    

    //destroy (eliminar logicamente un registro)
    public function destroy($id)
    {
      $ingreso = Ingreso::findOrFail($id);
      $ingreso -> estado = 'Cancelado'; 
      $ingreso -> update();

      return Redirect::to('compras/ingreso');
    }

}
