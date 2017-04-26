@extends ('layouts.admin')
@section ('contenido')
<div class="row">
    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
        <h3>Nuevo proveedor</h3>
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
        {{Form::open(array('url' => 'compras/proveedor', 'method' => 'POST', 'autocomplete' => 'off'))}}
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
               <label for="nombre">Apellido paterno:</label>
                <input type="text" class="form-control" name="a_paterno" placeholder="Apellido paterno..." required value="{{old('a_paterno')}}">            
            </div>
        </div>
          <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
             <div class="form-group">            
               <label for="nombre">Apellido Materno:</label>
                <input type="text" class="form-control" name="a_materno" placeholder="Apellido materno..."  value="{{old('a_materno')}}">            
            </div>
        </div>
         <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
             <div class="form-group">            
               <label for="nombre">Direccion:</label>
                <input type="text" class="form-control" name="direccion" placeholder="Direccion..."  value="{{old('direccion')}}">            
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
             <div class="form-group">            
               <label for="nombre">Documento:</label>
               <select name="tipo_documento" id="" class="form-control">                  
                   <option value="RFC">RFC</option> 
                   <option value="CURP">CURP</option>
                   <option value="INE">INE</option>
                   <option value="PASAPORTE">PASAPORTE</option>
               </select>
        </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <div class="form-group">            
               <label for="codigo">Numero de cocumento:</label>
                <input type="text" class="form-control" name="num_documento" placeholder="Numero de documento..."  value="{{old('num_documento')}}">            
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
             <div class="form-group">            
               <label for="stock">Telefono:</label>
                <input type="text" class="form-control" name="telefono" placeholder="Telefono..."  value="{{old('telefono')}}">            
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
             <div class="form-group">            
               <label for="descripcion">email:</label>
               <input type="email" class="form-control" name="email" placeholder="Email..."  value="{{old('email')}}">            
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