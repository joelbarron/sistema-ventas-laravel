<?php

namespace sistemaVentasUsbix\Http\Controllers;

use Illuminate\Http\Request;
use sistemaVentasUsbix\Categoria;
use Illuminate\Support\Facades\Redirect;
use sistemaVentasUsbix\Http\Requests\CategoriaFormRequest;
use DB;

class CategoriaController extends Controller
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
        $categorias = DB::table('categorias') 
        -> where('nombre','LIKE','%'.$querry.'%') 
        -> where('status','=','1')
        -> orderBy('id_categoria', 'asc')
        -> paginate(7);
        
        return view('almacen.categoria.index', ["categorias" => $categorias, "searchText" => $querry]);
      }
    }
    
    //create (mostra la vista de crear)
    public function create()
    {
      return view('almacen.categoria.create');
    }

    //show (mostrar la vista de show)
    public function show($id)
    {
      return view ('almacen.categoria.show', ['categoria' => Categoria::findOrFail($id)]);
    }

    //edit (mostrar la vista de editar)
    public function edit($id)
    {
      return view ('almacen.categoria.edit', ['categoria' => Categoria::findOrFail($id)]);
    }

    //store(insertar un registro)
    public function store(CategoriaFormRequest $request)
    {
      //creamos un objeto del tipo categoria
      $categoria = new Categoria;
      $categoria -> nombre = $request -> get('nombre');//este valor es el que se encuentra en el formulario
      $categoria -> descripcion = $request -> get('descripcion');
      $categoria -> status = 1;
      $categoria -> save();

      return Redirect::to('almacen/categoria');
    }

    //update (actualizar un registro)
    public function update(CategoriaFormRequest $request, $id)
    {
      $categoria = Categoria::findOrFail($id);
      $categoria -> nombre = $request -> get('nombre');//este valor es el que se encuentra en el formulario
      $categoria -> descripcion = $request -> get('descripcion');
      $categoria -> update();

      return Redirect::to('almacen/categoria');
    }

    //destroy (eliminar logicamente un registro)
    public function destroy($id)
    {
      $categoria = Categoria::findOrFail($id);
      $categoria -> status = 0;
      $categoria -> update();

      return Redirect::to('almacen/categoria');
    }

}
