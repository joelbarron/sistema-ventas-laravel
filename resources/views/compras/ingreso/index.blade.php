@extends ('layouts.admin') @section ('contenido')
<div class="row">
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
        <h3>Listado de Ingresos <a href="ingreso/create"><button class="btn btn-success">Nuevo</button></a></h3>
         @include('compras.ingreso.search') </div>
</div>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-condensed table-hover">
                <thead>
                    <th>ID</th>
                    <th>Fecha</th>
                    <th>Proveedor</th>
                    <th>Tipo de comprobante</th>
                    <th>Serie del comprobante</th>
                    <th>Numero del comprobante</th>
                    <th>Impuesto</th>
                    <th>Total</th> 
                    <th>Estado</th>                      
                    <th>Opciones</th>
                </thead>
                @foreach($ingresos as $ing)
                <tr>
                    <td>{{$ing -> id_ingreso}}</td>
                    <td>{{$ing -> fecha_hora}}</td>
                    <td>{{$ing -> nombre}} {{$ing -> a_paterno}}</td>
                    <td>{{$ing -> tipo_comprobante}}</td>
                    <td>{{$ing -> serie_comprobante}}</td>
                    <td>{{$ing -> num_comprobante}}</td>
                    <td>{{$ing -> impuesto}}</td>
                    <td>{{$ing -> total}}</td>                    
                    <td>{{$ing -> estado}}</td>                    
                    <td>
                        <a href="{{URL::action('IngresoController@show', $ing -> id_ingreso)}}">
                            <button class="btn btn-primary">Detalles</button>
                        </a>
                        <a href="" data-target="#modal-delete-{{$ing -> id_ingreso}}" data-toggle="modal">
                            <button class="btn btn-danger">Anular</button>
                        </a>
                    </td>
                </tr> 
                @include('compras.ingreso.modal')
                @endforeach </table>
        </div>
         {{$ingresos -> render()}}
    </div>
</div> 
@endsection