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
        <form action="">
          <div class="container">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <input type="hidden" name="titulo" id="titulo">
                  <input type="text" class="form-control" id="cliente-cita" name="idCliente" placeholder="Cliente">               
                </div>
              </div>  
              <div class="col-md-12">
                <div class="form-group">
                  <label for="">Actividad</label>
                    <select name="idActividad" id="actividad-cita" onfocusout="mostrarTitulo()" class="form-control">
                      <option value="1">Uñas</option>
                      <option value="2">Pies</option>
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
                    <input class="form-control" type="text" id="hora-cita" name="hora">               
                </div>               
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="">Responsable</label>
                    <select name="idUsuario" id="usuario-cita" class="form-control">
                      <option value="1">Usuario 1</option>
                    </select>               
                </div>
                <div class="form-group">
                  <label for="">Estado</label>
                    <select name="idEstado" id="estado-cita" class="form-control">
                      <option value="1">Nuevo</option>
                    </select>               
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <textarea name="detalleCita" class="form-control" id="detalle-cita" cols="30" rows="5" placeholder="Detalles"></textarea>              
                </div>
                <div class="form-group">
                  <input type="color" class="form-control" name="backgroundColor" id="color-cita">               
                </div>                
              </div>
            </div>
          </div>
          
        </form>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer d-flex justify-content">
        <button type="button" class="btn btn-sm btn-primary">Agregar</button>
        <button type="button" class="btn btn-sm btn-warning">Modificar</button>
        <button type="button" class="btn btn-sm btn-danger">Borrar</button>
        <button type="button" class="btn btn-sm btn-info" data-dismiss="modal">Cancelar</button>
      </div>

    </div>
  </div>
</div>

<script>

  function mostrarTitulo(){
    var actividad = $("#actividad-cita option:selected").text();
    $('#titulo-cita').html(actividad);
    $('#titulo').val(actividad);

  }

</script>

<script>

  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
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

      dateClick: function(info) {
        $('#fecha-cita').val(info.dateStr)
        $('#modalCrearCita').modal();
        calendar.addEvent({ title:"Nuevo evento", date:info.dateStr });
      },

      eventClick:function(info){
        console.log(info);
      },

      events: [
        {
          title: "Evento 1",
          start: "2021-01-07"
        }
      ]
      
    });

    calendar.setOption('locale', 'es');

    calendar.render();

    function recolectarDatos(method){

      nuevoEvento = {
        titulo: $('#titulo').val(),	
        fecha: $('#fecha-cita').val()+" "+$('#hora-cita').val(),
        backgroundColor: $('#color-cita').val(),
        idEstado: $('#estado-cita').val(),
        idActividad: $('#actividad-cita').val(),
        idUsuario: $('#usuario-cita').val(),
        idCliente: $('#cliente-cita').val(),
        detalleCita: $('#detalle-cita').val(),
        '_token':$("meta[name='csrf-token']").attr("content"),
        '_method':method
      }
    }

  });

</script>



@endsection