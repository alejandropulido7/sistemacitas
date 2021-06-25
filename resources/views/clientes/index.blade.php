@extends('layouts.app')

@section('content')

<div class="row">
<div class="col-md-12">
  <a class="btn btn-primary my-3" data-toggle="modal" data-target="#crearCliente" href="{{ url('/clientes/create')}}"><i class="material-icons">add</i>Agregar cliente</a>
  <div class="card">
    <div class="card-header card-header-primary">
      <h4 class="card-title">Clientes registrados</h4>
    </div>    
    <div class="card-body">
      <table class="table table-hover">
        <thead class="text.primary">
          <tr>
            <th>Nombre del cliente</th>
            <th>Correo</th>
            <th>Celular</th>
            <th>Cumpleaños</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($clientes as $cliente)
            <tr>
              <td>{{$cliente->nombreCliente}}</td>
              <td>{{$cliente->correoCliente}}</td>
              <td>{{$cliente->celularCliente}}</td>
              <td>{{$cliente->cumpleanosCliente}}</td>
              <td class="d-flex">
                <button class="btn btn-info mr-2">Editar</button>
                <form action="{{ url('/clientes/'.$cliente->id)}}" method="post">
                  {{ csrf_field() }}
                  {{method_field('DELETE')}}
                  <button type="submit" onclick="return confirm('¿Seguro desea borrar el registro?');" class="btn btn-danger">Borrar</button>
                </form>          
              </td>
            </tr>
          @endforeach
          
        </tbody>
      </table>


    </div>
  </div> 
</div>  

</div>

@endsection


 <!-- MODAL DE CLIENTES-->
 <div class="modal" id="crearCliente">
    <div class="modal-dialog">
      <div class="modal-content">
  
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Crear nuevo cliente</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
  
        <!-- Modal body -->
        <div class="modal-body">
            <form action="{{ url('/clientes') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                  <input type="text" class="form-control" placeholder="Nombre del cliente" name="nombreCliente" id="nombreCliente">
                </div>
                <div class="form-group">
                    <input type="email" class="form-control" placeholder="Correo" name="correoCliente" id="correoCliente">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Celular" name="celularCliente" id="celular">
                </div>
                <div class="form-group">
                    <input type="date" class="form-control" placeholder="Fecha de nacimiento (Cumpleaños)" name="cumpleanosCliente" id="cumpleanosCliente">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Dirección" name="direccionCliente" id="direccionCliente">
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Crear categoria</button>
                </div>
            </form>
        </div>
      </div>
    </div>
  </div>