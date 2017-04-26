@extends ('layouts.admin')
@section ('contenido')
<div class="row">
    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
        <h3>Nuevo Usuario</h3>
        @if (count($errors) > 0)
        <div class="alert alert-danger">
	        <ul>
	            @foreach($errors -> all() as $error)
	                <li>{{$error}}</li>
	            @endforeach
	        </ul>
        </div>
        @endif
        
        {{Form::open(array('url' => 'seguridad/usuario', 'method' => 'POST', 'autocomplete' => 'off'))}}
        {{Form::token()}}
        <div class="form-group">            
               <label for="nombre">Nombre:</label>
                <input type="text" class="form-control" name="name" placeholder="Nombre..." required>            
        </div>
        <div class="form-group">            
               <label for="nombre">Email:</label>
                <input type="text" class="form-control" name="email" placeholder="Email..." required>            
        </div>
        <div class="form-group">            
               <label for="descripcion">Contraseña:</label>
                <input type="password" class="form-control" name="password" required>            
        </div>
        <div class="form-group">            
               <label for="descripcion">Contraseña:</label>
                <input type="password" class="form-control" name="password_confirmation" required>                        
        </div>
        <div class="form-group">
            <button class="btn btn-primary" type="submit">Guardar</button>
            <button class="btn btn-danger" type="reset">Cancelar</button>
        </div>
        {{Form::close()}}
    </div>
</div>

@endsection