@extends('layouts.app')


@section('content')

<div class="container">

    <h1 class="ml-5">Agendar Citas</h1>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Agendar') }}</div>

                <div class="card-body">
                    <form method="POST" onsubmit="return verificarForm(event)" action="{{ route('cita.store')}}">
                        @csrf
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
                                <select class="form-control selection" id="medico" name="medico" required>

                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="fecha" class="col-md-4 col-form-label text-md-right">{{ __('Fecha') }}</label>
                            
                            <div class="col-md-6">
                                <input id="fecha" type="date" class="form-control" min= new Date().toISOString.split('T')[]  @error('fecha') is-invalid @enderror name="fecha" required autocomplete="fecha" autofocus>
                                @error('fecha')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        
                        <div class="form-group row">
                            <label for="hora" class="col-md-4 col-form-label text-md-right">{{ __('Hora') }}</label>
                            
                            <div class="col-md-6">
                                <input id="hora" type="time" class="form-control" @error('hora') is-invalid @enderror name="hora" required autocomplete="hora" autofocus>
                                @error('hora')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Agendar') }}
                                </button>        
                                <a class=" button btn btn-danger"href="{{route('cita.index')}}">Cancelar</a>           
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
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
        function changeSelector(id){
        $.ajax({
            type: 'get',
            url: '/especialidades/medicos/'+id,
            success: function (data) {
                var medicos = $('#medico');
                medicos
                .find('option')
                .remove();
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
                
                
            },
            error: function (data) {
                console.log('error', data);
            }
        });
    };

    $('#paciente').select2();

    $('#especialidad').select2({
        templateSelection: function (data) {
            changeSelector(data.id);
            return data.text
        }
    });
    $('#medico').select2();

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

    function verificarForm(event){
        if (fueraDeHorario()) {
            alert('hora fuera de horario');
            return false;
        }
        return true;
    }
    
</script>
@endsection
