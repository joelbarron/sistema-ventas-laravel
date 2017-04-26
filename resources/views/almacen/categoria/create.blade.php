@extends ('layouts.admin')
@section ('contenido')
<div class="row">
    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
        <h3>Nueva categoria</h3>
        @if (count($errors) > 0)
        <div class="alert alert-danger">
	        <ul>
	            @foreach($errors -> all() as $error)
	                <li>{{$error}}</li>
	            @endforeach
	        </ul>
        </div>
        @endif
        
        {{Form::open(array('url' => 'almacen/categoria', 'method' => 'POST', 'autocomplete' => 'off'))}}
        {{Form::token()}}
        <div class="form-group">            
               <label for="nombre">Nombre:</label>
                <input type="text" class="form-control" name="nombre" placeholder="Nombre...">            
        </div>
        <div class="form-group">            
               <label for="descripcion">Descripcion:</label>
                <input type="text" class="form-control" name="descripcion" placeholder="Descripcion...">            
        </div>
        <div class="form-group">
            <button class="btn btn-primary" type="submit">Guardar</button>
            <button class="btn btn-danger" type="reset">Cancelar</button>
        </div>
        {{Form::close()}}
    </div>
</div>

@endsection