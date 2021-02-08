@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header card-header-primary">
          <h4 class="card-title">Productos asignados</h4>
          <p class="card-category">Productos entregados a los usuarios</p>
        </div>    
        <div class="card-body">
        <table class="table table-hover">
            <thead class="text-primary">
              <tr>
                <th>#</th>
                <th>Nombre de producto</th>
                <th>Precio</th>
                <th>Marca del producto</th>
                <th>Proveedor</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($datosProductos as $producto)
                <tr>
                  <td>{{$loop->iteration}}</td>
                  <td>{{$producto->nombreProducto}}</td>
                  <td>{{"$".$producto->precioProducto}}</td>
                  <td>{{$producto->marcaProducto}}</td>
                  <td>{{$producto->proveedorProducto}}</td>
                  <td class="d-flex">
                    <button class="btn btn-info">Editar</button>
                    <form method="post" action="{{ url("productos/{$producto->id}")}}" >
                      {{ csrf_field() }}
                      @method('DELETE')
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