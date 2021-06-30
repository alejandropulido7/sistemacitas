@extends('layouts.app')

@section('content')

<div class="row">
<div class="col-md-12">
  <a class="btn btn-primary my-3" href="{{ url('/usuarios/create')}}"><i class="material-icons">add</i>Agregar empleado</a>
  <div class="card">
    <div class="card-header card-header-primary">
      <h4 class="card-title">Usuarios registrados</h4>
      <p class="card-category">Empleados</p>   
    </div>    
    <div class="card-body">
      <table class="table table-hover">
        <thead class="text.primary">
          <tr>
            <th>#</th>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Especialidad</th>
            <th>Rol</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($usuarios as $usuario)
            <tr>
              <td>{{$loop->iteration}}{{$usuario->enLinea}}</td>
              <td>{{$usuario->nombreCompleto}}</td>
              <td>{{$usuario->email}}</td>
              <td>{{$usuario->especialUsuario}}</td>
              <td>{{$usuario->idRol}}</td>          	
              <td class="nav-item dropdown d-flex">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" class="fas fa-x8 fa-angle-double-down"></a>
                <div class="dropdown-menu">
                  <button class="dropdown-item w-100 m-0">Editar</button>
                  <form action="{{ url('/usuarios/'.$usuario->id)}}" method="post">
                    {{ csrf_field() }}
                    {{method_field('DELETE')}}
                    <button type="submit" onclick="return confirm('¿Seguro desea borrar el registro?');" class="dropdown-item w-100 m-0">Borrar</button>
                  </form>
                </div>           
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