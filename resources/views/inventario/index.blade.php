@extends('layouts.app')


@section('content')

<div>
  
  @yield('inventario')
</div>


{{-- Listar inventario --}}
<div class="container">
<div class="row">
  <div class="col-md-6 col-sm-12">
    <div class="row mb-3">
      <div class="col-md-6">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#agregarInventario">
          Agregar producto
        </button>
      </div>    
    </div>
  </div>    
</div>
  <div class="row">
  <div class="col-md-6 col-sm-12">
    
    <div class="card">
      <div class="card-header card-header-primary">
        <h4 class="card-title">Productos en Stock</h4>
        <p class="card-category">Productos agregados al inventario</p>
      </div>    
      <div class="card-body">
          <table class="table table-hover">
            <thead class="text-primary">
              <tr>
                <th>#</th>
                <th>Fecha agregado</th>
                <th>Cantidad</th>
                <th>Nombre del producto</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              
                @foreach ($datosInventario as $inventario)
                  <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$inventario->fechaEntrada}}</td>
                    <td>{{$inventario->cantidadProducto}}</td>
                    <td>{{$inventario->nombreProducto}}</td>
                    <td class="">
                      <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" class="fas fa-x8 fa-angle-double-down"></a>
                      <div class="dropdown-menu">
                        <button data-toggle="modal" data-target="#editarInventario{{$inventario->id}}" class="dropdown-item w-100 m-0">Editar</button>                        
                      <form class="m-0" method="post" action="{{ route('inventario.destroy', $inventario)}}" >
                        {{ csrf_field() }}
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('¿Seguro desea borrar el registro?');" class="dropdown-item w-100 m-0">Borrar</button>
                      </form>
                      @if ($inventario->cantidadProducto != 0)
                        <button data-toggle="modal" data-target="#editarAsignacion" onclick="asignarUsuarios('{{$inventario->id}}','{{$inventario->cantidadProducto}}','{{$inventario->nombreProducto}}')" class="dropdown-item w-100 m-0">Asignar</button>  
                      @endif  
                      </div>
                              
                    </td>
                  </tr>
                @endforeach
            </tbody>
          </table>
        </div>
      </div>      
  </div>

  {{-- Tabla de asignaciones --}}

  <div class="col-md-6 col-sm-12">
    <div class="card">
      <div class="card-header card-header-warning">
        <h4 class="card-title">Productos asignados</h4>
        <p class="card-category">Productos entregados a los usuarios</p>
      </div>    
      <div class="card-body">
          <table class="table table-hover">
            <thead class="text-warning">
              <tr>
                <th>#</th>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Usuario asignado</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach ($datosAsignacion as $asignacion)
                <tr>
                  <td>{{$loop->iteration}}</td>
                  <td>{{$asignacion->nombreProducto}}</td>
                  <td>{{$asignacion->cantidadAsignada}}</td>
                  <td>{{$asignacion->nombreCompleto}}</td>
                  <td class="nav-item dropdown d-flex">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" class="fas fa-x8 fa-angle-double-down"></a>
                    <div class="dropdown-menu">
                      <button data-toggle="modal" data-target="#editarAsignacion" class="dropdown-item w-100 m-0">Editar</button>
                      <form class="m-0" method="post" action="{{ route('asignacion_prods.destroy', $asignacion)}}" >
                        {{ csrf_field() }}
                        @method('DELETE')
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
</div>


  <!-- MODAL DE AGREGAR INVENTARIO-->
  <div class="modal" id="agregarInventario">
    <div class="modal-dialog">
      <div class="modal-content">
  
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Agregar nuevo producto al inventario</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
  
        <!-- Modal body -->
        <div class="modal-body">
            <form action="{{ url('/inventario') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                  <input type="date" class="form-control" placeholder="Nombre de la categoria" value="" name="fechaEntrada" id="fechaEntradaAdd" required>
                </div>
                <div class="form-group">
                  <label for="">Producto</label>
                  <div class="d-flex">
                      <select name="idProducto" class="form-control col-sm-8 mr-3" id="idProducto" required>
                          <option value="">Seleccione..</option>
                          @foreach( $datosProductos as $producto)
                              @if (!$ProductosInventario->find($producto->id))
                                <option value="{{ $producto->id }}">{{ $producto->nombreProducto }}</option> 
                              @endif
                          @endforeach
                      </select>
                      <input type="number" class="form-control" placeholder="Cantidad" min="1" name="cantidadProducto" id="cantidadProducto" required>
                  </div>                    
              </div>             
        </div>  
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">Agregar producto</button>
        </form>
        </div>
  
      </div>
    </div>
  </div>

  
  <!-- MODAL DE EDITAR INVENTARIO-->
  @if (isset($inventario)) 
    <div class="modal" id="editarInventario{{$inventario->id}}">
      <div class="modal-dialog">
        <div class="modal-content">
    
          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Editar producto del inventario</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
    
          <!-- Modal body -->
          <div class="modal-body">
              <form action="{{ route('inventario.update', $inventario)}}" method="post" enctype="multipart/form-data" id='formEditar'>
                  {{ csrf_field() }}
                  @method('PUT')
                  <div class="form-group">
                    <input type="date" class="form-control" placeholder="Nombre de la categoria" value="{{$inventario->fechaEntrada}}" name="fechaEntrada" id="fechaEntradaEdit">
                  </div>
                  <div class="form-group">
                    <label for="">Producto</label>
                    <div class="d-flex">
                        <select name="idProducto" class="form-control col-sm-8 mr-3" disabled>
                            <option value="{{$inventario->idProducto}}">{{$inventario->nombreProducto}}</option>                          
                            @foreach( $datosProductos as $producto)
                            @if ($inventario->idProducto !== $producto->id)
                              <option value="{{ $producto->id }}">{{ $producto->nombreProducto }}</option>
                            @endif
                              
                            @endforeach
                        </select>
                      <input type="number" class="form-control" placeholder="Cantidad"  min="0" value="{{$inventario->cantidadProducto}}" name="cantidadProducto" id="cantidadProductoEdit">
                    </div>                    
                </div>             
          </div>
          <!-- Modal footer -->
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary">Actualizar inventario</button>
          </form>
          </div>
    
        </div>
      </div>
    </div>
      
  @endif

  <!-- MODAL DE EDITAR ASIGNACION-->
  <div class="modal" id="editarAsignacion">
    <div class="modal-dialog">
      <div class="modal-content">
  
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Asignar producto a un usuario</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
  
        <!-- Modal body -->
        <div class="modal-body">
            <form action="{{ url('/asignacion_prods') }}" method="post" enctype="multipart/form-data" id='formEditar'>
                {{ csrf_field() }}
                <div class="form-group">
                  <div class="col-sm-12 mr-2">
                  <label for="">Producto</label>
                    <input type="hidden" class="form-control" placeholder="Inventario #" name="idInventario" id="idInvenAsignado">                   
                    <input type="text" class="form-control" placeholder="Producto" id="productoAsignado" disabled> 
                  </div>                 
                </div>
                <div class="form-group">
                  <div class="d-flex">
                  <div class="col-sm-6 mr-2">
                    <label for="" >Asignar usuario</label>
                    <select name="idUsuario" class="form-control">
                        <option id="idUsuarioEdit">Seleccione..</option>
                        @foreach( $datosUsuario as $usuario)
                        <option value="{{ $usuario->id }}">{{ $usuario->nombreCompleto }}</option>
                        @endforeach
                    </select>                  
                  </div>                  
                  <div class="col-sm-6 mr-2">
                    <label for="" >Cantidad para asignar</label>  
                    <input type="number" class="form-control" placeholder="Cantidad" min="1" name="cantidadAsignada" id="cantidadAsignada"> 
                  </div>
                                
                  </div>          
              </div>
              <div class="form-group">
                <div class="col-sm-12 mr-2">
                  <label for="" >Detalle de la asignación</label>  
                  <input type="textarea" class="form-control" name="detalleAsignacion" id="detalleAsignacion"> 
                </div>
              </div>           
        </div>
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">Actualizar inventario</button>
        </form>
        </div>
  
      </div>
    </div>
  </div>


  <script>

    function asignarUsuarios(idInventario, cantidadProducto, nombreProducto) {
      $('#idInvenAsignado').val(idInventario);
      $('#productoAsignado').val(nombreProducto);
      $('#cantidadAsignada').val(cantidadProducto);
      $('#cantidadAsignada').attr('max',cantidadProducto);
    }

    // fecha = new Date();
    // mes = (fecha.getMonth()+1);
    // dia = (fecha.getDate());
    // anio = (fecha.getFullYear());
    // // mes = (mes<10)?"0"+mes:mes;
    // // dia = (dia<10)?"0"+dia:dia;
    // $('#fechaEntradaAdd').val(dia+"/"+mes+"/"+anio);
    // console.log(fecha);

  </script>


@endsection
