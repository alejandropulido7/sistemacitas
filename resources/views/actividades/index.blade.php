
@extends('layouts.app')

@section('content')


{{-- MODAL DE AGREGAR ACTIVIDAD --}}

<div class="row">
  {{-- Listar actividades --}}
<div class="col-md-5">
  <button type="button" class="btn btn-primary my-3" data-toggle="modal" data-target="#modalActividad">Agregar actividad</button>
  <div class="card">
    <div class="card-header card-header-primary">
      <h4 class="card-title">Actividades</h4>
      <p class="card-category"></p>   
    </div>    
    <div class="card-body">
      <table class="table table-hover">
        <thead class="text-primary">
          <tr>
            <th>Id</th>
            <th>Actividad</th>
            <th>Precio</th>
            <th>Tiempo requerido</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($actividades as $actividad)
            <tr>
              <td>{{$loop->iteration}}</td>
              <td>{{$actividad->nombreActividad}}</td>
              <td>{{$actividad->precioActividad}}</td>
              <td>{{$actividad->horaRequerida}} : {{$actividad->minRequerido}}</td>
              <td class="d-flex">
                <button class="btn btn-info">Editar</button>
                <form action="{{ route('actividades.destroy', $actividad->id)}}" method="post">
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



  <!-- The Modal -->
  <div class="modal" id="modalActividad">
    <div class="modal-dialog">
      <div class="modal-content">
  
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Agregar una actividad</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
  
        <!-- Modal body -->
        <form action="{{ url('/actividades')}}" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          
            {{ csrf_field() }}
            <div class="form-group">
              <input type="text" class="form-control" name="nombreActividad" id="nombreActividad" value="" placeholder="Nombre de actividad">
            </div>

            <div class="form-group">
              <input type="text" class="form-control" name="precioActividad" id="precioActividad" value="" placeholder="Precio de actividad">
            </div>

            <div class="form-group d-flex">
              <input type="text" class="form-control col-md-4" name="horaRequerida" id="horaRequerida" value="" placeholder="Horas">
              <label class="m-2 vertical-align"> : </label>
              <input type="text" class="form-control col-md-4" name="minRequerido" id="minRequerido" value="" placeholder="Min">
            </div>

        </div>
  
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary" >Agregar</button>
        </div>
        </form>
      </div>
    </div>
  </div>
@endsection