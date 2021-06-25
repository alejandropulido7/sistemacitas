@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-8">
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#crearProducto">
        Crear nuevo producto
      </button>
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


  <!-- MODAL DE NUEVO PRODUCTO-->
  <div class="modal" id="crearProducto">
    <div class="modal-dialog">
      <div class="modal-content">
  
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Crear un nuevo producto</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
  
        <!-- Modal body -->
        <div class="modal-body">
            <form action="{{ url('/productos') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                  <input type="text" class="form-control" placeholder="Nombre del producto" name="nombreProducto" id="nombreProducto">
                </div>
                <div class="form-group">
                  <input type="number" class="form-control" placeholder="Precio" name="precioProducto" id="precioProducto">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Marca" name="marcaProducto" id="marcaProducto">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Proveedor" name="proveedorProducto" id="proveedorProducto">
                </div>
                <div class="form-group">
                    <label for="">Categoria</label>
                    <div class="d-flex">
                        <select name="categoria_id" class="form-control col-sm-8 mr-3" id="categoria_id">
                            <option value="">Seleccione..</option>
                            @foreach( $datosCategoria as $categoria)
                            <option value="{{ $categoria->id }}">{{ $categoria->nombreCatProducto }}</option>
                            @endforeach
                        </select>
                        <a type="button" class="btn btn-link" data-toggle="modal" data-target="#crearCategoria">Crear categoria</a>
                    </div>                    
                </div>              
        </div>  
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-success">Crear producto</button>
        </form>
        </div>
  
      </div>
    </div>
  </div>