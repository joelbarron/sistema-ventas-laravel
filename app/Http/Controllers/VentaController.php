<?php

namespace sistemaVentasUsbix\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use sistemaVentasUsbix\Http\Requests\VentaFormRequest;
use sistemaVentasUsbix\Venta;
use sistemaVentasUsbix\DetalleVenta;
use DB;
use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;

class VentaController extends Controller
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
        $ventas = DB::table('ventas as v') 
        -> join('personas as p','v.id_cliente','=','p.id_persona')
        -> join('detalles_ventas as dv','v.id_venta','=','dv.id_venta')
        -> select('v.id_venta', 'v.fecha_hora', 'p.nombre', 'p.a_paterno', 'v.tipo_comprobante', 'v.serie_comprobante', 'v.num_comprobante', 'v.impuesto', 'v.estado', 'v.total_venta')
        -> where('v.num_comprobante','LIKE','%'.$querry.'%')         
        -> orderBy('v.id_venta', 'asc')
        -> groupBy('v.id_venta', 'v.fecha_hora', 'p.nombre', 'p.a_paterno', 'v.tipo_comprobante', 'v.serie_comprobante', 'v.num_comprobante', 'v.impuesto', 'v.estado')
        -> paginate(7);
        
        return view('ventas.venta.index', ["ventas" => $ventas, "searchText" => $querry]);
      }
    }

    //create (mostra la vista de crear)
    public function create()
    {
      $personas = DB::table('personas') -> where('tipo_persona', '=', 'Cliente') -> get();
      $articulos = DB::table('articulos as art')      
      -> select(DB::raw('CONCAT (art.codigo, " - " ,art.nombre) as  articulo'), 'art.id_articulo', 'art.stock', 'art.precio_venta')
      -> where ('art.estado', '=', 'Activo')
      -> where ('art.stock' , '>', '0')
      -> get();

      return view('ventas.venta.create', ['personas' => $personas, 'articulos' => $articulos]);
    }

    

    //store(insertar un registro)
    public function store(VentaFormRequest $request)
    {
      
    try {

    	DB::beginTransaction();

		$venta = new Venta;	    
	    $venta -> id_cliente = $request -> get('id_cliente');//este valor es el que se encuentra en el formulario
	    $venta -> tipo_comprobante = $request -> get('tipo_comprobante');
	    $venta -> serie_comprobante = $request -> get('serie_comprobante');
	    $venta -> num_comprobante = $request -> get('num_comprobante');
      $venta -> total_venta = $request -> get('total_venta');
	    $mytime = Carbon::now('America/Mexico_City');
	    $venta -> fecha_hora = $mytime -> toDateTimeString();
	    $venta -> impuesto = '16';
	    $venta -> estado = 'Aceptada';	    
	    $venta -> save();

	    $id_articulo  = $request -> get('id_articulo');
	    $cantidad = $request -> get('cantidad');
	    $descuento = $request -> get('descuento');
	    $precio_venta = $request -> get('precio_venta');

	    $cont=0;

	    while($cont < count ($id_articulo)){

	    	$detalle = new DetalleVenta();
	    	$detalle -> id_venta = $venta -> id_venta;
	    	$detalle -> id_articulo = $id_articulo[$cont];
	    	$detalle -> cantidad = $cantidad[$cont];
	    	$detalle -> descuento = $descuento[$cont];
	    	$detalle -> precio_venta = $precio_venta[$cont];
	    	$detalle -> save();
	    	
	    	$cont = $cont+1;
	    }

    	DB::commit();

    } catch (\Exception $e) {
    	DB::rollback();
    }

      return Redirect::to('ventas/venta');
    }

    //show
    public function show ($id){

    	$venta = DB::table('ventas as v') 
        -> join('personas as p','v.id_cliente','=','p.id_persona')
        -> join('detalles_ventas as dv','v.id_venta','=','dv.id_venta')
        -> select('v.id_venta', 'v.fecha_hora', 'p.nombre', 'p.a_paterno', 'v.tipo_comprobante', 'v.serie_comprobante', 'v.num_comprobante', 'v.impuesto', 'v.estado', 'v.total_venta')
        -> where ('v.id_venta','=', $id)
        -> first();


        $detalles = DB::table('detalles_ventas as d') 
         -> join('articulos as a','d.id_articulo','=','a.id_articulo')
         -> select('a.nombre as articulo', 'd.cantidad', 'd.descuento', 'd.precio_venta')
         -> where ('d.id_venta', '=', $id) -> get();

         return view('ventas.venta.show', ['venta' => $venta, 'detalles' => $detalles]);
    }

    //update (actualizar un registro)
    

    //destroy (eliminar logicamente un registro)
    public function destroy($id)
    {
      $venta =  Venta::findOrFail($id);
      $venta -> estado = 'Cancelada'; 
      $venta -> update();

      return Redirect::to('ventas/venta');
    }

}
