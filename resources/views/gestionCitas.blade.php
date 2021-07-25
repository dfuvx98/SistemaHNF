@extends('layouts.app')

@section('content')
    @csrf
    <div class="container my-5">
        <h1>Gestionar Citas</h1>
    </div>
    <div class="container">
        <div id="fullCalendar" style="background: #fff;">

        </div>
    </div>


      <!-- Modal -->
      <div class="modal fade " id="modalAgendaCita" tabindex="-1" role="dialog" aria-labelledby="modalAgendaCitaLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalAgendaCitaLabel">Modal title</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                @if (Auth::user()->role !== 'medico')
                    <form id="formCita">
                        <div class="form-group row">
                            <label for="paciente" class="col-md-4 col-form-label text-md-right">{{ __('Paciente') }}</label>
                            <div class="col-md-6">
                            <select class="form-control selection" id="paciente" name="paciente">
                                @if (isSet($personas))
                                    @foreach ($personas as $persona)
                                        <option value="{{ $persona->id}}">{{ $persona->nombre}} {{ $persona->apellido}}</option>
                                    @endforeach
                                    @else
                                    <option value="0">No existen pacientes</option>
                                @endif
                            </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="especialidad" class="col-md-4 col-form-label text-md-right">{{ __('Especialidad') }}</label>

                            <div class="col-md-6">
                                <select class="form-control selection" id="especialidad" name="especialidad" required>
                                    @if (isSet($especialidades))
                                        @foreach ($especialidades as $especialidad)
                                            <option value="{{ $especialidad->id}}">{{ $especialidad->nombre}}</option>
                                        @endforeach
                                        @else
                                        <option value="0">No existen especialidades</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="medico" class="col-md-4 col-form-label text-md-right">{{ __('Médico') }}</label>

                            <div class="col-md-6">
                                <select class="form-control selection" id="medico" name="medico" required >
                                    <option value="0">No existen medico de esta especialidad</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fecha" class="col-md-4 col-form-label text-md-right">{{ __('Fecha') }}</label>

                            <div class="col-md-6">
                                <input id="fecha" type="date" onfocus="abrirDateicker(this)"   class="form-control" min= new Date().toISOString.split('T')[]  @error('fecha') is-invalid @enderror name="fecha" required autocomplete="fecha" autofocus>
                                <span class="invalid-feedback" role="alert">
                                    <strong id="errorFecha">@error('fecha') {{ $message }} @enderror</strong>
                                </span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="hora" class="col-md-4 col-form-label text-md-right">{{ __('Hora') }}</label>

                            <div class="col-md-6">
                                <input id="hora" readonly type="time" value="10:00" class="form-control" onfocus="abrirTimerPicker(this)" @error('hora') is-invalid @enderror name="hora" required autocomplete="hora" autofocus>
                                <span class="invalid-feedback" role="alert">
                                    <strong id="errorHora">@error('hora') {{ $message }} @enderror</strong>
                                </span>
                            </div>
                        </div>
                    </form>
                @endif
            </div>
            <div class="modal-footer justify-content-center text-center">
                <div class="text-center">
                    <div class="row">
                    @if (Auth::user()->role !== 'medico')
                        <div class="col">
                            <button type="button" class="btn btn-success" onclick="AgendarCitas()">Agendar</button>
                        </div>
                        <div class="col">
                            <button type="button" class="btn btn-danger" id="botonCancelar" onclick="Cancelar()" style="display: none;">Cancelar</button>
                        </div>
                    @else
                        <button type="button" class="btn btn-success" onclick="Recetar()">Confirmar</button>
                    @endif
                        <div class="col">
                            <button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Modal para ver cita que ya esté agendada, falta hacer que guarde los datos -->
      <div class="modal fade " id="modalVerCita" tabindex="-1" role="dialog" aria-labelledby="modalVerCitaLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalVerCitaLabel">Modal title</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                @if (Auth::user()->role !== 'medico')
                    <form id="formCita">
                        <div class="form-group row">
                            <label for="paciente" class="col-md-4 col-form-label text-md-right">{{ __('Paciente') }}</label>
                            <div class="col-md-6">
                                <input class ="form-control" id="paciente2" name="paciente" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="especialidad" class="col-md-4 col-form-label text-md-right">{{ __('Especialidad') }}</label>
                            <div class="col-md-6">
                                <input class ="form-control"  id="especialidad2" name="especialidad" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="medico" class="col-md-4 col-form-label text-md-right">{{ __('Médico') }}</label>
                            <div class="col-md-6">
                                <input class ="form-control"  id="medico2" name="medico" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fecha" class="col-md-4 col-form-label text-md-right">{{ __('Fecha') }}</label>
                            <div class="col-md-6">
                                <input id="fecha2" type="date"  readonly class="form-control" min= new Date().toISOString.split('T')[]  @error('fecha') is-invalid @enderror name="fecha" required autocomplete="fecha" autofocus>
                                <span class="invalid-feedback" role="alert">
                                    <strong id="errorFecha">@error('fecha') {{ $message }} @enderror</strong>
                                </span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="hora" class="col-md-4 col-form-label text-md-right">{{ __('Hora') }}</label>

                            <div class="col-md-6">
                                <input id="hora2" type="time" value="10:00"  readonly class="form-control"  @error('hora') is-invalid @enderror name="hora" required autocomplete="hora" autofocus>
                                <span class="invalid-feedback" role="alert">
                                    <strong id="errorHora">@error('hora') {{ $message }} @enderror</strong>
                                </span>
                            </div>
                        </div>
                    </form>
                @endif
            </div>
            <div class="modal-footer justify-content-center text-center">
                <div class="text-center">
                    <button type="button" class="btn btn-danger" id="botonCancelar" onclick="Cancelar()" style="display: none;">Cancelar</button>
                    <button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
          </div>
        </div>
      </div>
      <!--Modal incompleto de si toca la consulta hacerla en modal
      <div class="modal fade " id="modalRegistrarConsulta" tabindex="-1" role="dialog" aria-labelledby="modalRegistrarConsultaLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalRegistrarConsultaLabel">Modal title</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                    <form id="formCita">
                        <div class="form-group row">
                            <label for="nombre" class="col-md-4 col-form-label text-md-right">{{ __('Nombres') }}</label>
                            <div class="col-md-6">
                                <input class ="form-control" id="nombre" name="nombre" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="apellido" class="col-md-4 col-form-label text-md-right">{{ __('Apellidos') }}</label>
                            <div class="col-md-6">
                                <input class ="form-control"  id="apellido" name="apellido" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="cedula" class="col-md-4 col-form-label text-md-right">{{ __('Cédula') }}</label>
                            <div class="col-md-6">
                                <input class ="form-control"  id="cedula" name="cedula" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fecha" class="col-md-4 col-form-label text-md-right">{{ __('Fecha') }}</label>
                            <div class="col-md-6">
                                <input id="fecha" type="date" readonly onfocus="abrirDateicker(this)"   class="form-control" min= new Date().toISOString.split('T')[]  @error('fecha') is-invalid @enderror name="fecha" required autocomplete="fecha" autofocus>
                                <span class="invalid-feedback" role="alert">
                                    <strong id="errorFecha">@error('fecha') {{ $message }} @enderror</strong>
                                </span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="hora" class="col-md-4 col-form-label text-md-right">{{ __('Hora') }}</label>

                            <div class="col-md-6">
                                <input id="hora" readonly type="time" disabled value="10:00" class="form-control" onfocus="abrirTimerPicker(this)" @error('hora') is-invalid @enderror name="hora" required autocomplete="hora" autofocus>
                                <span class="invalid-feedback" role="alert">
                                    <strong id="errorHora">@error('hora') {{ $message }} @enderror</strong>
                                </span>
                            </div>
                        </div>
                    </form>
            </div>
            <div class="modal-footer justify-content-center text-center">
                <div class="text-center">
                    <div class="row">
                    @if (Auth::user()->role !== 'medico')
                        <div class="col">
                            <button type="button" class="btn btn-success" onclick="AgendarCitas()">Agendar</button>
                        </div>
                        <div class="col">
                            <button type="button" class="btn btn-danger" id="botonCancelar" onclick="Cancelar()" style="display: none;">Cancelar</button>
                        </div>
                    @else
                        <button type="button" class="btn btn-success" onclick="Recetar()">Confirmar</button>
                    @endif
                        <div class="col">
                            <button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
          </div>
        </div>
      </div>
      -->

@endsection
@section('css_extra')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .select2-container .select2-selection--single {
        height: 37px;
    }
</style>
@endsection
@section('js_extras')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    const rolUsuario = '{{Auth::user()->role}}';
    // seleccionamos el contenedor o div donde se va a dibujar el full calendar
    const calendarEl = document.getElementById('fullCalendar');
    // la variable la inicializamos vacía
    let calendar = null;
    /// es esta seccion comenzaremos a configurar los pickers de hora y fecha de la libreria de mdDateTimePicker
    // definimos la zona horaria de la libreria moment
    moment.locale("es");
    // definimos que esta sea una variable tipo time
    let timePicker = new mdDateTimePicker.default({
        type: 'time',
    });
    // definimos que esta sea una variable del tipo date
    let datePicker = new mdDateTimePicker.default({
        type: 'date',
        // configuramos la fecha inicial del picker
        init: moment(),
        // configuramos la fecha maxima anterior del picker
        past: moment(),
        // configuramos la fecha maxima pposterior del picker
        future: moment().add(40, 'years'),
    });

    // configuramos los botones custom del sweet alert
    const customButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-outline-success ml-2 mr-2',
            cancelButton: 'btn btn-outline-info ml-2 mr-2',
            denyButton: 'btn btn-outline-danger ml-2 mr-2',
        },
        buttonsStyling: false,
    });
    idAModificar = 0
    eventAModificar = null;
    // declarar variable de título de Modal
    TitleModal = '';
    // asignamos a la variable global "calendar" el tipo de variable de FULL CALENDAR
    calendar = new FullCalendar.Calendar(calendarEl, {
                locale: 'es',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                allDaySlot: false,
                editable: true,
                //Lista de todas las citas, vacía porque aun no coje valores
                events: [],
                slotMinTime:'08:00:00',
                displayEventTime: true,
                slotMaxTime:'18:00:00',
                selectable: true,
                droppable: false,
                editable: false,
                //funcion en caso de hacer click en vacio
                select: function (event) {
                    if(event.view.type !== 'dayGridMonth') {
                        if ( rolUsuario === 'medico') { return;}
                        $('#modalAgendaCita').modal('show');
                        $('#modalAgendaCita').on('hide.bs.modal', hiddenPickers);
                        TitleModal = 'Agendar Citas';
                        document.getElementById('modalAgendaCitaLabel').innerHTML = TitleModal
                        const date = new Date(event.start)
                        timePicker.time = moment(date);
                        datePicker.time = moment(date);
                        document.getElementById('fecha').value = date.toISOString().split('T')[0];
                        let hora = date.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
                        document.getElementById('hora').value = date.getHours() < 10 && hora[0] !== '0' ? '0'+hora : hora;
                        document.getElementById('botonCancelar').style.display = 'none';

                    } else if (event.view.type === 'dayGridMonth') {
                        calendar.gotoDate(event.start);
                        calendar.changeView('timeGridDay');
                    }
                },
                /*eventDrop: function (info) {
                    if ( rolUsuario === 'medico') { info.revert(); return;}
                    const date = new Date(info.event.start)
                    if ( date < new Date()) {
                        info.revert();
                        return
                    }
                    const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' }
                    const hora = date.toLocaleTimeString([], {hour: '2-digit', minute: '2-digit' });
                    const fecha = date.toISOString().split('T')[0]
                    customButtons.fire({
                            title: 'Está seguro de continuar?',
                            text: "La cita será movida a \n"+ date.toLocaleDateString('es-ES', options) + " a las " + hora,
                            icon: 'warning',
                            showCancelButton: true,
                            showCloseButton: true,
                            confirmButtonText: 'Sí, continuar!',
                            cancelButtonText: 'No, Cancelar!',
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    idAModificar = info.event.id
                                    eventAModificar = info.event
                                    var ajax = new XMLHttpRequest();
                                    ajax.open('POST', '/Cita/dropUpdate', true);
                                    let data = new FormData();
                                    data.append('id_cita',idAModificar);
                                    data.append('hora',hora);
                                    data.append('fecha',fecha);
                                    //codigo para poner la cita en la base de datos
                                    ajax.setRequestHeader('X-CSRF-TOKEN', document.querySelector("input[name='_token']").value);
                                    ajax.send(data);
                                    //codigo para meter la cita en el fullCalendar
                                    ajax.onload = () => {
                                        if(ajax.responseText){
                                            console.log('response', ajax.responseText);
                                            const response = JSON.parse(ajax.responseText);
                                            if(response.success){
                                                return;
                                            }
                                        }
                                        info.revert();
                                    }
                                } else {
                                    info.revert();
                                }
                        })
                },*/
                /*eventClick: function (info) {
                    //llamar modal
                    $('#modalAgendaCita').modal('show');
                    $('#modalAgendaCita').on('hide.bs.modal', hiddenPickers);
                    if (rolUsuario !== 'medico') {
                        //poner titulo al modal si se modifica
                        TitleModal = 'Modificar Cita';
                        //Metet el titulo en el modal
                        document.getElementById('modalAgendaCitaLabel').innerHTML = TitleModal
                        //llamar datos de la cita asignada en el full calendar
                        datos =info.event._def.extendedProps.data;
                        //coger la fecha del evento
                        const date = new Date(info.event.start)
                        timePicker.time = moment(date);
                        datePicker.time = moment(date);

                        document.getElementById('fecha').value = date.toISOString().split('T')[0];
                        let hora = date.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
                        document.getElementById('hora').value = date.getHours() < 10 && hora[0] !== '0' ? '0'+hora : hora;
                        idAModificar = info.event.id
                        eventAModificar = info.event
                        document.getElementById('botonCancelar').style.display = 'block';
                        console.log('datos', datos);
                        //si hay datos del paciente asignar paciente en el modal
                        if (datos.paciente) {

                            var paciente = $('#paciente');
                            paciente.val(datos.idPersonaP).change();
                            $("#paciente option").attr("selected", false);
                            $("#paciente option").prop("selected", false);
                            $("#paciente option[value='"+datos.idPersonaP+"']").attr("selected", true);
                            $("#paciente option[value='"+datos.idPersonaP+"']").prop("selected", true);
                            $('#select2-paciente-container').html(datos.paciente.nombre+' '+datos.paciente.apellido)
                        }
                        if (datos.especialidades) {
                            var especialidad = $('#especialidad');
                            especialidad.val(datos.idEspecialidad).change();
                            $("#paciente option").attr("selected", false);
                            $("#paciente option").prop("selected", false);
                            $("#paciente option[value='"+datos.idEspecialidad+"']").attr("selected", true);
                            $("#paciente option[value='"+datos.idEspecialidad+"']").prop("selected", true);
                            $('#select2-especialidad-container').html(datos.especialidades.nombre);
                            changeSelector(datos.idEspecialidad, datos.medico);
                        }
                    }
                    else {
                        TitleModal = 'Recetar Cita';
                        //Metet el titulo en el modal
                        document.getElementById('modalAgendaCitaLabel').innerHTML = TitleModal
                    }
                }*/eventClick: function (info) {
                    //llamar modal
                    $('#modalVerCita').modal('show');
                    $('#modalVerCita').on('hide.bs.modal', hiddenPickers);
                    if (rolUsuario !== 'medico') {
                        //poner titulo al modal si se modifica
                        TitleModal = 'Datos Cita';
                        //Metet el titulo en el modal
                        document.getElementById('modalVerCitaLabel').innerHTML = TitleModal
                        //llamar datos de la cita asignada en el full calendar
                        datos =info.event._def.extendedProps.data;
                        //coger la fecha del evento
                        const date = new Date(info.event.start)
                        timePicker.time = moment(date);
                        datePicker.time = moment(date);

                        document.getElementById('fecha2').value = date.toISOString().split('T')[0];
                        let hora = date.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
                        document.getElementById('hora2').value = date.getHours() < 10 && hora[0] !== '0' ? '0'+hora : hora;
                        idAModificar = info.event.id
                        eventAModificar = info.event
                        //document.getElementById('botonCancelar').style.display = 'block';
                        console.log('datos', datos);
                        //si hay datos del paciente asignar paciente en el modal
                        if (datos.paciente) {
                            document.getElementById('paciente2').value = datos.paciente.nombre+' '+datos.paciente.apellido;
                            /*var paciente = $('#paciente');
                            paciente.val(datos.idPersonaP).change();
                            $("#paciente option").attr("selected", false);
                            $("#paciente option").prop("selected", false);
                            $("#paciente option[value='"+datos.idPersonaP+"']").attr("selected", true);
                            $("#paciente option[value='"+datos.idPersonaP+"']").prop("selected", true);
                            $('#select2-paciente-container').html(datos.paciente.nombre+' '+datos.paciente.apellido)*/
                        }
                        if (datos.especialidades) {
                            document.getElementById('especialidad2').value = datos.especialidades.nombre;
                            document.getElementById('medico2').value =datos.medico.nombre+ " "+ datos.medico.apellido;
                            /*var especialidad = $('#especialidad');
                            especialidad.val(datos.idEspecialidad).change();
                            $("#paciente option").attr("selected", false);
                            $("#paciente option").prop("selected", false);
                            $("#paciente option[value='"+datos.idEspecialidad+"']").attr("selected", true);
                            $("#paciente option[value='"+datos.idEspecialidad+"']").prop("selected", true);
                            $('#select2-especialidad-container').html(datos.especialidades.nombre);
                            changeSelector(datos.idEspecialidad, datos.medico);*/
                        }
                    }
                    else {
                        /*
                        TitleModal = 'Consulta de Cita';
                        //Metet el titulo en el modal
                        document.getElementById('modalAgendaCitaLabel').innerHTML = TitleModal
                        */
                    }
                },
                eventRemove: function(dd){
                    console.log('dd',dd)
                },
    });
    calendar.render();

    function AgendarCitas() {
        if ( idAModificar > 0 && eventAModificar != null) {
            Modificar();
            return;
        }
        const fueraDeHora = fueraDeHorario();
        const form = document.getElementById('formCita');
        if (fueraDeHora) {
            const errorHora = document.getElementById('errorHora');
            errorHora.innerHTML = 'Fuera de horario'
            form.hora.setAttribute('is-invalid',true)
            return;
        } else {
            const fecha = new Date(form.fecha.value+'T00:00:00');
            if (fecha < new Date()){
                return;
            }
            if (form.paciente.value === null || form.paciente.value === 0) { return;}
            if (form.especialidad.value === null || form.especialidad.value === 0) { return;}
            if (form.medico.value === null || form.medico.value === 0) { return;}
            const selectPaciente = document.querySelector('#paciente');
            const paciente = selectPaciente.options[selectPaciente.selectedIndex].text;
            const nombrePaciente = paciente.split(' ');

            const selectEspecialidad = document.querySelector('#especialidad');
            const especialidad = selectEspecialidad.options[selectEspecialidad.selectedIndex].text;

            const selectMedico = document.querySelector('#medico');
            const medico = selectMedico.options[selectMedico.selectedIndex].text;
            const nombreMedico = medico.split(' ');

            var ajax = new XMLHttpRequest();
            ajax.open('POST', '/Cita/agendar', true);
            let data = new FormData(form);
            //codigo para poner la cita en la base de datos
            ajax.setRequestHeader('X-CSRF-TOKEN', document.querySelector("input[name='_token']").value);
            ajax.send(data);
            //codigo para meter la cita en el fullCalendar
            ajax.onload = () => {
                if(ajax.responseText){
                    const response = JSON.parse(ajax.responseText);
                    console.log(response)
                    if(response.success){
                        const hora = form.hora.value.split(':');
                        const finHora = parseInt(hora[1])+30;
                        nuevo = {
                            id: response.cita.id,
                            title: 'Medico: '+nombreMedico[2]+' '+nombreMedico[3]+' '+nombreMedico[0]+' '+nombreMedico[1]+'\n Paciente:'+
                            nombrePaciente[2]+' '+nombrePaciente[3]+' '+nombrePaciente[0]+' '+nombrePaciente[1]+'\nEspecialidad: '+especialidad,
                            allDay: false,
                            start: form.fecha.value+' '+form.hora.value,
                            end: form.fecha.value+' '+hora[0]+':'+finHora,
                        };
                        calendar.addEvent(nuevo);
                        $('#modalAgendaCita').modal('hide');

                    }
                }
            }
        }
    }

    /*function Modificar() {
        if ( idAModificar > 0  && eventAModificar != null) {
            const fueraDeHora = fueraDeHorario();
            const form = document.getElementById('formCita');
            if (fueraDeHora) {
                const errorHora = document.getElementById('errorHora');
                errorHora.innerHTML = 'Fuera de horario'
                form.hora.setAttribute('is-invalid',true)
                return;
            } else {
                const fecha = new Date(form.fecha.value+'T00:00:00');
                if (fecha < new Date()){
                    return;
                }
                if (form.paciente.value === null || form.paciente.value === 0) { return;}
                if (form.especialidad.value === null || form.especialidad.value === 0) { return;}
                if (form.medico.value === null || form.medico.value === 0) { return;}
                const selectPaciente = document.querySelector('#paciente');
                const paciente = selectPaciente.options[selectPaciente.selectedIndex].text;
                const nombrePaciente = paciente.split(' ');

                const selectEspecialidad = document.querySelector('#especialidad');
                const especialidad = selectEspecialidad.options[selectEspecialidad.selectedIndex].text;

                const selectMedico = document.querySelector('#medico');
                const medico = selectMedico.options[selectMedico.selectedIndex].text;
                const nombreMedico = medico.split(' ');

                var ajax = new XMLHttpRequest();
                ajax.open('POST', '/Cita/modificar', true);
                let data = new FormData(form);
                data.append('id_cita',idAModificar);
                //codigo para poner la cita en la base de datos
                ajax.setRequestHeader('X-CSRF-TOKEN', document.querySelector("input[name='_token']").value);
                ajax.send(data);
                //codigo para meter la cita en el fullCalendar
                ajax.onload = () => {
                    if(ajax.responseText){
                        const response = JSON.parse(ajax.responseText);
                        console.log(response)
                        if(response.success){
                            const hora = form.hora.value.split(':');
                            const finHora = parseInt(hora[1])+30;
                            eventAModificar.setDates(form.fecha.value+' '+form.hora.value, form.fecha.value+' '+hora[0]+':'+finHora)
                            // funcion para cambiar color
                            //eventAModificar.setProp('color','#fffff')
                            $('#modalAgendaCita').modal('hide');
                        }
                    }
                }
            }
        }
    }
    */
    function Cancelar() {
        if ( idAModificar > 0  && eventAModificar != null) {
        var ajax = new XMLHttpRequest();
        ajax.open('POST', '/Cita/cancelar', true);
            let data = new FormData();
            data.append('id_cita',idAModificar);
            ajax.setRequestHeader('X-CSRF-TOKEN', document.querySelector("input[name='_token']").value);
            ajax.send(data);
            ajax.onload = () => {
                if(ajax.responseText){
                    const response = JSON.parse(ajax.responseText);
                    if(response.success){
                        eventAModificar.setProp('color','#455a64')
                        $('#modalAgendaCita').modal('hide');
                        }
                    }
                }
            }
        }


    function fueraDeHorario() {
        const horaTxt = document.getElementById('hora').value.split(':');
        var hora = parseInt(horaTxt[0]);
        var minutos = parseInt(horaTxt[1]);
        var fueraHorario = false;
        if((hora < 9 || (hora >= 12 && minutos >  0) ) && (hora < 16 || (hora >= 18 && minutos > 0))) {
            fueraHorario=true
        }
        if (!fueraHorario){
            if(minutos != 0  && minutos != 30 ) {
                fueraHorario=true
            }
        }
        return fueraHorario;
    }


    function hiddenPickers () {
        idAModificar = 0;
        eventAModificar = null;
        if ( rolUsuario === 'medico') { return;}
        timePicker.hide();
        datePicker.hide();
    }


    function abrirTimerPicker(object) {
        timePicker.toggle();
        timePicker.trigger = object
        object.addEventListener('onOk', function() {
            const date = new Date(timePicker.time)
            let value = date.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
            if (date.getHours() < 10 && value[0] !== '0') {
                value = '0'+value;
            }
            this.value = value
        });
    }

    function abrirDateicker(object) {
        datePicker.toggle();
        datePicker.trigger = object
        object.addEventListener('onOk', function() {
            const date = new Date(datePicker.time)
            value = date.toISOString().split('T')[0];
            this.value = value
        });
    }

    function changeSelector(id, infoMedico){
        console.log('cambiando Esecialidad')
        $.ajax({
            type: 'get',
            //Voy con Url de la ruta en vez del nombre
            url: '/especialidades/medicos/'+id,
            success: function (data) {
                var medicos = $('#medico');
                medicos
                .find('option')
                .remove();
                if (data.length > 0 ) {
                    for (const key in data) {
                        var datos = data[key];
                        var text = datos.nombre+' '+datos.apellido;
                        var option = new Option(text, datos.id, false, false);
                        medicos.append(option).trigger('change');
                        // manually trigger the `select2:select` event
                        medicos.trigger({
                            type: 'select2:select',
                            params: {
                                data: datos
                            }
                        });
                    }
                    if (infoMedico) {
                        medicos.val(infoMedico.id).change();
                        $("#paciente option").attr("selected", false);
                        $("#paciente option").prop("selected", false);
                        $("#paciente option[value='"+infoMedico.id+"']").attr("selected", true);
                        $("#paciente option[value='"+infoMedico.id+"']").prop("selected", true);
                        $('#select2-paciente-container').html(infoMedico.nombre+' '+infoMedico.apellido)

                    }
                } else {
                    var option = new Option('No existen medico de esta especialidad', 0, false, true);
                    medicos.append(option).trigger('change');
                }

            },
            error: function (data) {
                console.log('error', data);
            }
        });
    };

    $('#paciente').select2({
        dropdownParent: $('#modalAgendaCita'),
    });

    $('#especialidad').select2({
        dropdownParent: $('#modalAgendaCita'),
        templateSelection: function (data) {
            changeSelector(data.id, null);
            return data.text
        }
    });
    $('#medico').select2({
        dropdownParent: $('#modalAgendaCita'),
    });

    // funcion ajax que traer todas las citas y posteriormente se agrega al calentario
    $.ajax({
        type: 'get',
        url: '/Cita/obtener',
        success: function (data) {
            if(data.error){

            } else {
                console.log('citas', data);
                for (const key in data) {
                    // se llama evento a cada item del full calendar
                    const cita = data[key];
                    const medico = cita.medico;
                    const hora = cita.hora.split(':');
                    const finHora = parseInt(hora[1])+30;
                    // se estructura los datos de la cita como un evento de full calendar
                    nuevo = {
                        id: cita.id,
                        title: 'Medico: '+medico.apellido+' '+medico.nombre+'\n Paciente:'+
                                cita.paciente.apellido+' '+cita.paciente.nombre+'\nEspecialidad: '+cita.especialidades.nombre,
                        allDay: false,
                        start: cita.fecha+' '+cita.hora,
                        end: cita.fecha+' '+hora[0]+':'+finHora,
                        data: cita,
                    }
                    // dependiendo del estado de la cita se le asigna un color al evento
                    /*
                        estado = 0 (cancelada)
                        estado = 1 (agendada)
                        estado = 2 (realizada)
                        estado = 3 (no se presento a la cita)
                    */
                    if(cita.estado === 0){
                        nuevo['color'] = '#455a64';
                    } else if(cita.estado === 2) {
                        nuevo['color'] = '#6a1b9a';
                    }
                    else if (cita.estado == 3) {
                        nuevo['color'] = '#ffa000';
                    }
                    if(calendar !== null){
                        calendar.addEvent(nuevo);
                    }
                }
            }
        },
        error: function (data) {
            console.log('error', data);
        }
    });

    function Recetar() {
        console.log('recetar')
    }

  </script>

  <style>
      input[type=date].form-control[readonly], input[type=time].form-control[readonly]{
          background-color: white;
      }
  </style>
@endsection

