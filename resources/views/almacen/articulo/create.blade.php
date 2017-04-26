@extends ('layouts.admin')
@section ('contenido')
<div class="row">
    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
        <h3>Nuevo Articulo</h3>
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
        {{Form::open(array('url' => 'almacen/articulo', 'method' => 'POST', 'autocomplete' => 'off', 'files' => 'true'))}}
        {{Form::token()}}
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
             <div class="form-group">            
               <label for="nombre">Nombre:</label>
                <input type="text" class="form-control" name="nombre" placeholder="Nombre..." required value="{{old('nombre')}}">            
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
             <div class="form-group">            
               <label for="nombre">Categoria:</label>
               <select name="id_categoria" id="" class="form-control">
                  @foreach($categorias as $cat)
                   <option value="{{$cat -> id_categoria}}">{{$cat -> nombre}}</option>
                   @endforeach
               </select>
        </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <div class="form-group">            
               <label for="codigo">Codigo:</label>
                <input type="text" class="form-control" name="codigo" placeholder="Codigo..." required value="{{old('codigo')}}">            
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
             <div class="form-group">            
               <label for="stock">Stock:</label>
                <input type="text" class="form-control" name="stock" placeholder="Stock..." required value="{{old('stock')}}">            
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
             <div class="form-group">            
               <label for="stock">Precio de venta:</label>
                <input type="text" class="form-control" name="precio_venta" placeholder="Precio venta..." required value="{{old('precio_venta')}}">            
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
             <div class="form-group">            
               <label for="descripcion">Descripcion:</label>
               <input type="text" class="form-control" name="descripcion" placeholder="Descripcion..." required value="{{old('descripcion')}}">            
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
             <div class="form-group">            
               <label for="imagen">Imagen:</label>                
                <input type="file" class="form-control" name="imagen">            
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