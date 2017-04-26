@extends ('layouts.admin')
@section ('contenido')
<div class="row">
    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
        <h3>Editar Articulo: {{$articulo -> nombre}}</h3>
        @if (count($errors) > 0)
        <div class="alert alert-danger">
	        <ul>
	            @foreach($errors -> all() as $error)
	                <li>{{$error}}</li>
	            @endforeach
	        </ul>
        </div>
        @endif
    </div>
</div>       
        
        {{Form::model($articulo, ['method' => 'PATCH', 'route' => ['articulo.update', $articulo -> id_articulo], 'files' => 'true'])}}
        {{Form::token()}}
        <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
             <div class="form-group">            
               <label for="nombre">Nombre:</label>
                <input type="text" class="form-control" name="nombre" placeholder="Nombre..." required value="{{$articulo -> nombre}}">            
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
             <div class="form-group">            
               <label for="nombre">Categoria:</label>
               <select name="id_categoria" id="" class="form-control">
                  @foreach($categorias as $cat)
                      @if($cat ->id_categoria == $articulo -> id_categoria)
                           <option value="{{$cat -> id_categoria}}" selected>{{$cat -> nombre}}</option>
                    @else
                            <option value="{{$cat -> id_categoria}}" >{{$cat -> nombre}}</option>
                    @endif
                   @endforeach
               </select>
        </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <div class="form-group">            
               <label for="codigo">Codigo:</label>
                <input type="text" class="form-control" name="codigo"  required value="{{$articulo->codigo}}">            
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
             <div class="form-group">            
               <label for="stock">Stock:</label>
                <input type="text" class="form-control" name="stock"  required value="{{$articulo->stock}}">          
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
             <div class="form-group">            
               <label for="stock">Precio de venta:</label>
                <input type="text" class="form-control" name="precio_venta"  required value="{{$articulo->precio_venta}}">          
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
             <div class="form-group">            
               <label for="descripcion">Descripcion:</label>
               <input type="text" class="form-control" name="descripcion" placeholder="Descripcion.." required value="{{$articulo->descripcion}}">        
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
             <div class="form-group">            
               <label for="imagen">Imagen:</label>                
                <input type="file" class="form-control" name="imagen">            
                @if(($articulo-> imagen) != "")
                    <img src="{{asset('imagenes/articulos/'.$articulo->imagen)}}" alt="imagen" style="height: 250px; width:300px; background-size: contain;">
                @endif
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
          <div class="form-group">
            <button class="btn btn-primary" type="submit">Guardar</button>
            <button class="btn btn-danger" type="reset">Cancelar</button>
            </div>  
        </div>
    </div> 
        {{Form::close()}}

@endsection