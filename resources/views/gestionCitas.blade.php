@extends('layouts.app')

@section('content')
    @csrf
    @if (Auth::user()->role === 'administrador')
    <div class="container my-5">
        <h1>Gestionar Citas</h1>
    </div>
    @else
    <div class="container my-5">
        <h1>Agenda de citas</h1>
    </div>
    @endif
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
                                <input id="fecha" type="date" readonly   class="form-control" min= new Date().toISOString.split('T')[]  @error('fecha') is-invalid @enderror name="fecha" required autocomplete="fecha" autofocus>
                                <span class="invalid-feedback" role="alert">
                                    <strong id="errorFecha">@error('fecha') {{ $message }} @enderror</strong>
                                </span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="hora" class="col-md-4 col-form-label text-md-right">{{ __('Hora') }}</label>

                            <div class="col-md-6">
                                <input id="hora" readonly type="time" value="10:00" class="form-control" @error('hora') is-invalid @enderror name="hora" required autocomplete="hora" autofocus>
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
                        <div class="col">
                            <button type="button" class="btn btn-success" onclick="AgendarCitas()">Agendar</button>
                        </div>
                        <div class="col">
                            <button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Modal para ver cita que ya esté agendada -->
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
                <form id="formCita2" >
                    <div class="form-group row">
                        <label for="paciente" class="col-md-4 col-form-label text-md-right">{{ __('Paciente') }}</label>
                        <div class="col-md-6">
                            <input class ="form-control" id="paciente2" name="paciente" readonly>
                        </div>
                    </div>
                    @if (Auth::user()->role === 'medico')
                    <div class="form-group row">
                        <label for="cedula" class="col-md-4 col-form-label text-md-right">{{ __('Cédula') }}</label>
                        <div class="col-md-6">
                            <input class ="form-control" id="cedula" name="cedula" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Correo Electrónico') }}</label>
                        <div class="col-md-6">
                            <input class ="form-control" id="email" name="email" readonly>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="telefono" class="col-md-4 col-form-label text-md-right">{{ __('Teléfono') }}</label>
                        <div class="col-md-6">
                            <input class ="form-control" id="telefono" name="telefono" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="fecha3" class="col-md-4 col-form-label text-md-right">{{ __('Fecha de nacimiento') }}</label>
                        <div class="col-md-6">
                            <input id="fecha3" type="date"  readonly class="form-control" min= new Date().toISOString.split('T')[]  @error('fecha') is-invalid @enderror name="fecha3" required autocomplete="fecha" autofocus>
                            <span class="invalid-feedback" role="alert">
                                <strong id="errorFecha">@error('fecha') {{ $message }} @enderror</strong>
                            </span>
                        </div>
                    </div>
                    @endif
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
                    @if (Auth::user()->role === 'medico')
                        <div class="form-group row" style =display:none>
                            <label for="idCita" class="col-md-4 col-form-label text-md-right">{{ __('idCita') }}</label>
                            <div class="col-md-6">
                                <input class ="form-control" id="idCita" name="idCita" style =display:none readonly>
                            </div>
                        </div>

                        <h6>Datos de Consulta</h6>
                        <div class="form-group row">
                            <label for="sintomas" class="col-md-4 col-form-label text-md-right">{{ __('Síntomas') }}</label>
                            <div class="col-md-6">
                                <textarea id="sintomas" name="sintomas"> </textarea>
                                <span class="invalid-feedback" role="alert">
                                    <strong id="errorHora">@error('hora') {{ $message }} @enderror</strong>
                                </span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tratamiento" class="col-md-4 col-form-label text-md-right">{{ __('Tratamiento') }}</label>
                            <div class="col-md-6">
                                <textarea id="tratamiento" name="tratamiento"> </textarea>
                                <span class="invalid-feedback" role="alert">
                                    <strong id="errorHora">@error('hora') {{ $message }} @enderror</strong>
                                </span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="diagnostico" class="col-md-4 col-form-label text-md-right">{{ __('Diagnóstico') }}</label>
                            <div class="col-md-6">
                                <textarea id="diagnostico" name="diagnostico"> </textarea>
                                <span class="invalid-feedback" role="alert">
                                    <strong id="errorHora">@error('hora') {{ $message }} @enderror</strong>
                                </span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fechaControl" class="col-md-4 col-form-label text-md-right">{{ __('Fecha Proximo Control') }}</label>
                            <div class="col-md-6">
                                <input id="fechaControl" type="date" readonly onfocus="abrirDatepicker(this)" class="form-control" min= new Date().toISOString.split('T')[]  @error('fecha') is-invalid @enderror name="fechaControl" required autocomplete="fechaControl" autofocus>
                                <span class="invalid-feedback" role="alert">
                                    <strong id="errorFecha">@error('fecha') {{ $message }} @enderror</strong>
                                </span>
                            </div>
                        </div>
                        <label for="solExalemens" class="col-md-4 col-form-label text-md-right">{{ __('Solicitar Exámenes') }}</label>
                        <div class="row">
                            <div class="col-2"></div>
                            <div class="form-check col">
                                <input class="form-check-input" type="radio" name="solicitaExamenes" id="solicitaExamenes1" value="si">
                                <label class="form-check-label" for="solicitaExamenes1">
                                  Si
                                </label>
                            </div>
                            <div class="form-check col">
                                <input class="form-check-input" type="radio" name="solicitaExamenes" id="solicitaExamenes" value="no" checked>
                                <label class="form-check-label" for="solicitaExamenes">
                                    No
                                </label>
                            </div>
                            <div class="col-2"></div>
                        </div>
                        <div class="content_detail_examen" style="display: none">
                            <div class="form-group row">
                                <label for="detalles" class="col-md-4 col-form-label text-md-right">{{ __('Detalles') }}</label>
                                <div class="col-md-6">
                                    <textarea id="detalles" name="detalleExamen"> </textarea>
                                    <span class="invalid-feedback" role="alert">
                                        <strong id="errorHora">@error('hora') {{ $message }} @enderror</strong>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="tiposExamenes" class="col-md-4 col-form-label text-md-right">{{ __('Tipos de Exámenes') }}</label>
                                <div class="col-md-6">
                                    <select class="form-control selection" id="tiposExamenes" name="tiposExamenes[]" style="width: 100%" multiple="multiple" required>
                                        @if (isSet($tiposExamenes))
                                            @foreach ($tiposExamenes as $tiposExamene)
                                                <option value="{{ $tiposExamene->id}}">{{ $tiposExamene->nombre}}</option>
                                            @endforeach
                                        @else
                                            <option value="0">No existen tipos de examenes</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                        <label class="col-md-4 col-form-label text-md-right">{{ __('Receta') }}</label>
                        <div class="form-group row">
                            <label for="medicamento_receta" class="col-md-4 col-form-label text-md-right">{{ __('Medicamentos') }}</label>
                            <div class="col-md-6">
                                <textarea id="medicamento_receta" name="medicamento_receta"> </textarea>
                                <span class="invalid-feedback" role="alert">
                                    <strong id="errorMedicamento">@error('hora') {{ $message }} @enderror</strong>
                                </span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tratamiento_receta" class="col-md-4 col-form-label text-md-right">{{ __('Tratamiento') }}</label>
                            <div class="col-md-6">
                                <textarea id="tratamiento_receta" name="tratamiento_receta"> </textarea>
                                <span class="invalid-feedback" role="alert">
                                    <strong >@error('hora') {{ $message }} @enderror</strong>
                                </span>
                            </div>
                        </div>
                    @endif
                </form>
            </div>
            <div class="modal-footer justify-content-center text-center">
                <div class="text-center">
                    <div class="row">
                        @if (Auth::user()->role === 'medico')
                        <div class="col">
                            <button type="button" class="btn btn-success" id="botonCancelar" onclick="Consulta()">Guardar</button>
                        </div>
                        @elseif (Auth::user()->role === 'administrador')
                        <div class="col">
                            <button type="button" class="btn btn-danger" id="botonCancelar" onclick="Cancelar()">Cancelar</button>
                        </div>
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


@endsection
@section('css_extra')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">
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



    if (rolUsuario === 'medico') {
        const radios = document.querySelectorAll('input[name="solicitaExamenes"]');
        radios.forEach( radio => {
            radio.addEventListener('change', () => {
                const value = radio.value
                console.log('content',  document.querySelector('.content_detail_examen'))
                if (value === 'si') {
                    document.querySelector('.content_detail_examen').style.display = 'block';
                }else{
                    //Aquí en este else lo que hago es esconder los valores a llenar de los exámenes si hago
                    //una solicitud de examen y eso ya lo hago bien pero para cuando se pueda lo que quiero saber es
                    //como hago para poder vaciar los valores del select, el valor del detalle ya lo vacío
                    document.querySelector('.content_detail_examen').style.display = 'none';
                    document.getElementById('detalles').value = '';
                    /*var tiposExamenes = $('#tiposExamenes');
                    tiposExamenes.val().change();
                    $("#tiposExamenes option").attr("selected", false);
                    $("#tiposExamenes option").prop("selected", false);*/
                }
            })
        })
    }
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
                    right: 'dayGridMonth,timeGridWeek'
                },
                allDaySlot: false,
                editable: true,
                //Lista de todas las citas, vacía porque aun no coje valores
                events: [],
                slotMinTime:'09:00:00',
                displayEventTime: true,
                slotMaxTime:'18:00:00',
                selectable: true,
                droppable: false,
                editable: false,
                //funcion en caso de hacer click en vacio
                select: function (event) {
                    if(event.view.type !== 'dayGridMonth') {
                        fechaActual = new Date();
                        const date = new Date(event.start);
                        timePicker.time = moment(date);
                        datePicker.time = moment(date);
                        //validar que no sea fecha anterior a la fecha u hora actual
                        if ( rolUsuario === 'medico') { return;}
                        if(date<fechaActual){
                            console.log(fechaActual);
                            Swal.fire({
                            icon: 'error',
                            title: 'Fecha no permitida',
                            text: 'No se puede agendar antes de la fecha actual ',
                        });
                            return;
                        }
                        $('#modalAgendaCita').modal('show');
                        $('#modalAgendaCita').on('hide.bs.modal', hiddenPickers);
                        TitleModal = 'Agendar Citas';
                        document.getElementById('modalAgendaCitaLabel').innerHTML = TitleModal


                        document.getElementById('fecha').value = date.toISOString().split('T')[0];
                        let hora = date.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
                        document.getElementById('hora').value = date.getHours() < 10 && hora[0] !== '0' ? '0'+hora : hora;


                    } else if (event.view.type === 'dayGridMonth') {
                        calendar.gotoDate(event.start);
                        calendar.changeView('timeGridDay');
                    }
                },
                
                    eventClick: function (info) {
                    //llamar modal
                        datos =info.event._def.extendedProps.data;
                        fechaActual = new Date();
                        console.log(fechaActual);
                        if(rolUsuario == 'medico' && datos.estado !==1){
                            return;
                        }
                        if(rolUsuario == 'medico' && info.event.start<fechaActual){
                            console.log(fechaActual);
                            return;
                        }
                        $('#modalVerCita').modal('show');
                        $('#modalVerCita').on('hide.bs.modal', hiddenPickers);
                        //poner titulo al modal si se modifica
                        TitleModal = 'Datos Cita';
                        //Metet el titulo en el modal
                        document.getElementById('modalVerCitaLabel').innerHTML = TitleModal
                        //llamar datos de la cita asignada en el full calendar

                        if (rolUsuario == 'medico'){
                            document.getElementById('idCita').value = datos.id;
                        }

                        //coger la fecha del evento
                        const date = new Date(info.event.start)
                        timePicker.time = moment(date);
                        datePicker.time = moment(date);

                        document.getElementById('fecha2').value = date.toISOString().split('T')[0];
                        let hora = date.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
                        document.getElementById('hora2').value = date.getHours() < 10 && hora[0] !== '0' ? '0'+hora : hora;
                        idAModificar = info.event.id
                        eventAModificar = info.event
                        if(rolUsuario == 'administrador'){
                            if(datos.estado !=1){
                                document.getElementById('botonCancelar').style.display = 'none';
                            }else{
                                document.getElementById('botonCancelar').style.display = 'block';
                        }
                        }
                        //document.getElementById('botonCancelar').style.display = 'block';
                        console.log('datos', datos);
                        //si hay datos del paciente asignar paciente en el modal
                        if (datos.paciente !== undefined && datos.paciente != null) {
                            document.getElementById('paciente2').value = datos.paciente.nombre+' '+datos.paciente.apellido;

                            if(rolUsuario == 'medico'){
                            document.getElementById('cedula').value = datos.paciente.cedula;
                            document.getElementById('email').value = datos.paciente.email;
                            document.getElementById('telefono').value = datos.paciente.telefono;
                            document.getElementById('fecha3').value = datos.paciente.fechaNacimiento;
                            }
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

                },
                eventRemove: function(dd){
                    console.log('dd',dd)
                },
    });
    calendar.render();

    function AgendarCitas() {
        if ( idAModificar > 0 && eventAModificar != null) {
            return;
        }
        const fueraDeHora = fueraDeHorario();
        const form = document.getElementById('formCita');
        if (fueraDeHora) {
            const errorHora = document.getElementById('errorHora');
            errorHora.innerHTML = 'Fuera de horario'
            form.hora.setAttribute('is-invalid',true)
            console.log('Fuera de horario');
            Swal.fire({
                icon: 'error',
                title: 'Error al agendar cita',
                text: 'El horario de las citas es de 9:00 a 12:00 y de 16:00 a 18:00 ',
            });
            return;
        } else {
            const fecha = new Date(form.fecha.value+'T00:00:00');
            
                console.log(fecha);
                console.log(new Date());
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
            console.log(data);
            //codigo para poner la cita en la base de datos
            ajax.setRequestHeader('X-CSRF-TOKEN', document.querySelector("input[name='_token']").value);
            ajax.send(data);
            //codigo para meter la cita en el fullCalendar
            ajax.onload = () => {
                if(ajax.responseText){
                    const response = JSON.parse(ajax.responseText);
                    console.log(response);
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
                            data:response.cita,
                        };
                        calendar.addEvent(nuevo);
                        $('#modalAgendaCita').modal('hide');

                    }else{
                        if(response.error)
                        Swal.fire({
                            icon: 'error',
                            title: 'Error al agendar cita',
                            text: 'El médico ya tiene ocupado ese horario en otra cita',
                        });
                    }
                }
            }
        }
    }

    
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
                        else{
                            return;
                        }
                    }
                }
            }
        }

    function Consulta() {
        const form = document.getElementById('formCita2');
        var ajax = new XMLHttpRequest();
        ajax.open('POST', '/Consulta/guardar', true);
        let data = new FormData(form);

            //data.append('id_cita',idAModificar);
            ajax.setRequestHeader('X-CSRF-TOKEN', document.querySelector("input[name='_token']").value);
            ajax.send(data);
            ajax.onload = () => {
                if(ajax.responseText){
                    const response = JSON.parse(ajax.responseText);
                    console.log(response);
                    const exito ="Se registro la consulta con exito";
                    if(response == exito ){
                        eventAModificar.setProp('color','#6a1b9a');
                        $('#modalVerCita').modal('hide');
                        //falta que enseguida se cierre el modal ya en el full calendar cuente como
                        //que ya no es posible entrar al modal. No deja entrar al modal cuando se cambia el
                        //estado de la cita pero es necesario refrescar para que aplique
                        }
                    }
                }
    }


    function fueraDeHorario() {
        //Cogemos la hora y la partimos en 2
        const horaTxt = document.getElementById('hora').value.split(':');
        var hora = parseInt(horaTxt[0]);
        var minutos = parseInt(horaTxt[1]);
        var fueraHorario = false;
        if (hora < 13 ) {
            if((hora < 9 || (hora >= 12 && minutos >  0) ) ) {
                fueraHorario=true
            }
        } else {
            if ((hora < 16 || (hora >= 18 && minutos > 0))) {
                fueraHorario=true
            }
        }
        if (!fueraHorario){
            if(minutos != 0  && minutos != 30 ) {
                fueraHorario=true
            }
        }
        return fueraHorario;
    }

    //Funcion que se ejecuta cuando cierro el modal
    function hiddenPickers () {
        idAModificar = 0;
        eventAModificar = null;
        if (rolUsuario === 'medico'){
            document.querySelector('.content_detail_examen').style.display = 'none';
        $(this).find('form').trigger('reset');
            }

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

    function abrirDatepicker(object) {
        datePicker.toggle();
        datePicker.trigger = object
        object.addEventListener('onOk', function() {
            const date = new Date(datePicker.time)
            value = date.toISOString().split('T')[0];
            this.value = value
        });
    }

    function changeSelector(id, infoMedico){
        var medicos = $('#medico');
                medicos
                .find('option')
                .remove();

            medicos.val(null).change();

        $.ajax({
            type: 'get',
            //Voy con Url de la ruta en vez del nombre
            url: '/especialidades/medicos/'+id,
            success: function (data) {
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

    $('#tiposExamenes').select2({
        dropdownParent: $('#modalVerCita'),
    });

    // funcion ajax que trae todas las citas y posteriormente se agrega al calentario
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

