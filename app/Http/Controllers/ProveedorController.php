<?php

namespace sistemaVentasUsbix\Http\Controllers;

use Illuminate\Http\Request;
use sistemaVentasUsbix\Persona;
use Illuminate\Support\Facades\Redirect;
use sistemaVentasUsbix\Http\Requests\PersonaFormRequest;
use DB;


class ProveedorController extends Controller
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
        $personas = DB::table('personas') 
        -> where('nombre','LIKE','%'.$querry.'%') 
        -> where('tipo_persona','=','Proveedor')
        -> orwhere('num_documento','LIKE','%'.$querry.'%') 
        -> where('tipo_persona','=','Proveedor')
        -> orderBy('id_persona', 'asc')
        -> paginate(7);
        
        return view('compras.proveedor.index', ["personas" => $personas, "searchText" => $querry]);
      }
    }
    
    //create (mostra la vista de crear)
    public function create()
    {
      return view('compras.proveedor.create');
    }

    //show (mostrar la vista de show)
    public function show($id)
    {
      return view ('compras.proveedor.show', ['persona' => Persona::findOrFail($id)]);
    }

    //edit (mostrar la vista de editar)
    public function edit($id)
    {
      return view ('compras.proveedor.edit', ['persona' => Persona::findOrFail($id)]);
    }

    //store(insertar un registro)
    public function store(PersonaFormRequest $request)
    {
      //creamos un objeto del tipo categoria
      $persona = new Persona;
      $persona -> tipo_persona = 'Proveedor';
      $persona -> nombre = $request -> get('nombre');//este valor es el que se encuentra en el formulario
      $persona -> a_paterno = $request -> get('a_paterno');
      $persona -> a_materno = $request -> get('a_materno');
      $persona -> tipo_documento = $request -> get('tipo_documento');
      $persona -> num_documento = $request -> get('num_documento');
      $persona -> direccion = $request -> get('direccion');
      $persona -> telefono = $request -> get('telefono');
      $persona -> email = $request -> get('email');
      $persona -> save();

      return Redirect::to('compras/proveedor');
    }

    //update (actualizar un registro)
    public function update(PersonaFormRequest $request, $id)
    {
      $persona = Persona::findOrFail($id);         
      $persona -> nombre = $request -> get('nombre');//este valor es el que se encuentra en el formulario
      $persona -> a_paterno = $request -> get('a_paterno');
      $persona -> a_materno = $request -> get('a_materno');
      $persona -> tipo_documento = $request -> get('tipo_documento');
      $persona -> num_documento = $request -> get('num_documento');
      $persona -> direccion = $request -> get('direccion');
      $persona -> telefono = $request -> get('telefono');
      $persona -> email = $request -> get('email');
      $persona -> update();

      return Redirect::to('compras/proveedor');
    }

    //destroy (eliminar logicamente un registro)
    public function destroy($id)
    {
      $persona = Persona::findOrFail($id);
      $persona -> tipo_persona = 'Inactivo'; 
      $persona -> update();

      return Redirect::to('compras/proveedor');
    }

}
