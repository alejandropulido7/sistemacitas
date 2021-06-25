@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-md"></div>
  <div class="col-md-10">
    <div id='calendar'></div>
  </div>
  <div class="col-md"></div>
</div>

<!-- The Modal -->
<div class="modal" id="modalCrearCita">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Cita: <span id=titulo-cita></span></h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form id="form-modal-citas" action="">
          <div class="container">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <div id="cont-id"></div>
                  <input type="hidden" name="titulo" id="titulo">
                  <input type="hidden" name="idCliente" id="id-cliente-cita">
                  <input type="text" id="cliente-cita" class="form-control" placeholder="Cliente">  
                  <br>
                  <div id="cliente" class="d-flex flex-row justify-content-between align-content-center"></div>
                  {{-- <select id="cliente-cita" class="form-control" name="idCliente" title="Seleccione cliente..">
                    @foreach( $datosCliente as $cliente)
                      <option value="{{ $cliente->id }}">{{ $cliente->nombreCliente }}</option>
                    @endforeach
                  </select> --}}
                  
                </div>
              </div>  
              <div class="col-md-12">
                <div class="form-group">
                  <label for="">Actividad</label>
                    <select name="idActividad" id="actividad-cita" onfocusout="mostrarTitulo()" class="form-control">
                      @foreach( $datosActividades as $actividad)
                      <option value="{{ $actividad->id }}">{{ $actividad->nombreActividad }}</option>
                      @endforeach
                    </select>               
                </div>
              </div>
              <div class="mt-3 col-md-6">
                <div class="form-group">
                  <label for="">Fecha</label>
                  <br>
                  <input type="date" id="fecha-cita" name="fecha" class="form-control" placeholder="Fecha">               
                </div>  
                <div class="form-group">
                  <label for="">Hora</label>
                  <br>
                  <div class="d-inline-flex justify-content-between">
                    <input class="form-control" type="number" id="hora-cita" name="hora" max="24" placeholder="Hora">
                    <input class="form-control ml-3" type="number" id="min-cita" name="min" max="59" placeholder="Min">
                  </div>             
                </div>               
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="">Responsable</label>
                    <select name="idUsuario" id="usuario-cita" class="form-control">
                      <option value="">Seleccione..</option>
                          @foreach( $datosUsuario as $usuario)
                          <option value="{{ $usuario->id }}">{{ $usuario->nombreCompleto }}</option>
                          @endforeach
                    </select>               
                </div>
                <div class="form-group">
                  <label for="">Estado</label>
                    <select name="idEstado" id="estado-cita" class="form-control">
                      @foreach( $datosEstados as $estados)
                      <option value="{{ $estados->id }}">{{ $estados->nombreEstado }}</option>
                      @endforeach
                    </select>               
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <textarea name="detalleCita" class="form-control" id="detalle-cita" cols="30" rows="5" placeholder="Detalles"></textarea>              
                </div>
                <div class="form-group">
                  <label for="">Color</label>
                  <input type="color" class="form-control" name="backgroundColor" id="color-cita">               
                </div>                
              </div>
            </div>
          </div>
          
        </form>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer d-flex justify-content">
        <button id="btn-agregar" type="button" class="btn btn-sm btn-primary">Agregar</button>
        <button id="btn-modificar" type="button" class="btn btn-sm btn-warning">Modificar</button>
        <button id="btn-borrar" type="button" class="btn btn-sm btn-danger">Borrar</button>
        <button id="btn-cancelar" type="button" class="btn btn-sm btn-info" data-dismiss="modal">Cancelar</button>
      </div>

    </div>
  </div>
</div>

<script>

  //MUESTRA EL TITULO DE LA ACTIVIDAD REALIZADA ESCOGIDA EN EL SELECT
  function mostrarTitulo(){
    let actividad = $("#actividad-cita option:selected").text();
    $('#titulo-cita').html(actividad);
    $('#titulo').val(actividad);
  };

  function agregarCliente(id){
    consultarIdCliente(id);
    $('#id-cliente-cita').val(id);
    $('#cliente').empty();
  };

  function consultarIdCliente(id){
      $.ajax({
        type: "GET",
        url: "{{ route('citas.nombreCliente') }}?id="+id,
        data: id,
        success: function (data) {
          $('#cliente-cita').val(data[0]['nombreCliente'])
        },
        error:function(){
           alert("Error cargar cliente en modal");
           }
        });
    };


  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    //-------------------------- Empieza eventos -------------------------
    var calendar = new FullCalendar.Calendar(calendarEl, {
      // plugins: [ 'listPlugin' ],
      initialView: 'dayGridMonth',

      themeSystem: 'bootstrap',

      headerToolbar:{
        start: 'today prev,next crearCita', 
        center: 'title',
        end: 'dayGridMonth, timeGridWeek, timeGridDay'
      },

      customButtons: {
       crearCita: {
        text: 'Crear cita',
        click: function() {
          $('#modalCrearCita').modal();          
          }
        }
      },

      //CREAR CITA AL DARLE CLICK A UNA FECHA EN LA GRID
      dateClick: function(info) {
        $('#fecha-cita').val(info.dateStr);
        $('#modalCrearCita').modal();
        $('#btn-agregar').css({
          display : 'flex'
        });
        $('#btn-modificar').css({
          display: 'none'
        });
        $('#btn-borrar').css({
          display: 'none'
        });
        limpiarFormulario();
      },

      //CONSULTA LOS DATOS DEL EVENTO AL DARLE CLICK EN EL EVENTO
      eventClick:function(info){
        $('#cont-id').append("<input type='hidden' id='idCita' name='id'></input>")
        mes = (info.event.start.getMonth()+1);
        dia = (info.event.start.getDate());
        anio = (info.event.start.getFullYear());
        mes = (mes<10)?"0"+mes:mes;
        dia = (dia<10)?"0"+dia:dia;
        hora = (info.event.start.getHours());
        min = (info.event.start.getMinutes());
        $('#modalCrearCita').modal();
        $('#idCita').val(info.event.id);
        $('#titulo').val(info.event.title);	
        $('#fecha-cita').val(anio+"-"+mes+"-"+dia);
        $('#hora-cita').val(hora);
        $('#min-cita').val(min);
        $('#color-cita').val(info.event.backgroundColor);
        $('#estado-cita').val(info.event._def.extendedProps.idEstado);
        $('#actividad-cita').val(info.event._def.extendedProps.idActividad);
        $('#usuario-cita').val(info.event._def.extendedProps.idUsuario);
        $('#id-cliente-cita').val(info.event._def.extendedProps.idCliente);
        consultarIdCliente(info.event._def.extendedProps.idCliente);
        $('#detalle-cita').val(info.event._def.extendedProps.detalleCita);
        $('#btn-agregar').css({
          display : 'none'
        });
        $('#btn-modificar').css({
          display: 'inline-block'
        });
        $('#btn-borrar').css({
          display: 'inline-block'
        });
      },

      //MOSTRAR LOS EVENTOS
      events: "{{ url('/citas/show')}}"
      
    });
    //------------------------- Termina eventos -----------------------

    //CAMBIA EL IDIOMA A ESPAÑOL
    calendar.setOption('locale', 'es');
    //SE RENDERIZA EL CALENDARIO (MOSTRAR)
    calendar.render();

    //INSERTAR LA CITA(EVENTO) A LA BASE DE DATOS
    $('#btn-agregar').click(function(){
      objCita = recolectarDatos('POST');
      enviarInformacion('',objCita);
    });

    $('#btn-borrar').click(function(){
      objCita = recolectarDatos('DELETE');
      enviarInformacion('/'+$('#idCita').val(),objCita);
    });

    $('#btn-modificar').click(function(){
      objCita = recolectarDatos('PUT');
      enviarInformacion('/'+$('#idCita').val()+'/update',objCita);
    });
    

    function limpiarFormulario(){
      $("form select").each(function() { this.selectedIndex = 0 });
     $("form input[type=text] , form textarea, form input[type=number], form input[type=color]").each(function() { this.value = '' });
     $('#cliente').empty();
    };

    //RECOLECTA LOS DATOS DEL MODAL DE "CREAR CITA"
    function recolectarDatos(method){
      nuevoEvento = {
        title: $('#titulo').val(),	
        start: $('#fecha-cita').val()+" "+$('#hora-cita').val()+":"+$('#min-cita').val(),
        backgroundColor: $('#color-cita').val(),
        idEstado: $('#estado-cita').val(),
        idActividad: $('#actividad-cita').val(),
        idUsuario: $('#usuario-cita').val(),
        idCliente: $('#id-cliente-cita').val(),
        detalleCita: $('#detalle-cita').val(),
        '_token':$("meta[name='csrf-token']").attr("content"),
        '_method':method
      }
      return(nuevoEvento);
    };

    //SE ENVIA LA INFORMACION POR AJAX PARA CREAR LA CITA
    function enviarInformacion(accion, objCita){
      $.ajax({
        type: "POST",
        url: "{{ url('/citas') }}"+accion,
        data: objCita,
        success: function (msg) {
          $('#modalCrearCita').modal('toggle');
          calendar.refetchEvents(); //ACTUALIZAR CALENDARIO CUANDO SE INSERTA INFORMACION
        },
        error:function(){ alert("Error de procesado");}
      });
    };

    //MOSTRAR SUGERENCIAS DE CLIENTES PARA AGREGARLO A LA CITA
    $("#cliente-cita").keyup(function () { 
    var nombre = $("#cliente-cita").val();
      if((nombre.length)>=3)
        {
          mostrarCliente(nombre);
        }
      else
        {
          $('#cliente').empty();
        }  
    });

    

    let actividad = $("#actividad-cita option:selected").text();
    $('#titulo-cita').html(actividad);
    $('#titulo').val(actividad);
  


    //SE CONSULTAN LOS CLIENTES POR MEDIO DE AJAX
    function mostrarCliente(cliente){
      $.ajax({
        type: "GET",
        url: "{{ route('citas.buscarCliente') }}?texto="+cliente,
        data: cliente,
        success: function (data) {
          $('#cliente').empty();
          data.forEach(element => {
            $('#cliente').append("<span>"+element['nombreCliente']+"</span><span>"+element['celular']+"</span><button id='usar-cliente' onclick='agregarCliente("+element['id']+")' type='button' class='btn btn-sm btn-primary'>Usar</button>");
          });
        }
      });
    };

  });
</script>


@endsection