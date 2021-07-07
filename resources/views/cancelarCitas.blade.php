@extends('layouts.app')

@section('js_extras')

@endsection

@section('css_extra')
@endsection

@section('content')

<div class="container">

    <h1 class="ml-5">Cancelar Citas</h1>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('cita.delete', $cita) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <label for="Paciente" class="col-md-4 col-form-label text-md-right">{{ __('Paciente') }}</label>
                            <div class="col-md-6">
                                <input id="paciente" type="text" class="form-control-plaintext" @error('paciente') is-invalid @enderror name="paciente" value="{{ $cita->Paciente->nombre}}" required autocomplete="paciente" disabled>
                                @error('paciente')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        

                        <div class="form-group row">
                            <label for="especialidad" class="col-md-4 col-form-label text-md-right">{{ __('Especialidad') }}</label>
                            <div class="col-md-6">
                                <input id="especialidad" type="text" class="form-control-plaintext" @error('especialidad') is-invalid @enderror name="especialidad" value="{{ $cita->Especialidades->nombre}}" required autocomplete="especialidad" disabled>
                                @error('especialidad')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="medico" class="col-md-4 col-form-label text-md-right">{{ __('Médico') }}</label>
                            
                            <div class="col-md-6">
                                <input id="medico" type="text" class="form-control-plaintext" @error('medico') is-invalid @enderror name="medico" value="{{ $cita->Medico->nombre}}" required autocomplete="medico" disabled>
                                @error('medico')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="fecha" class="col-md-4 col-form-label text-md-right">{{ __('Fecha') }}</label>
                            
                            <div class="col-md-6">
                                <input id="fecha" type="date" class="form-control-plaintext" @error('fecha') is-invalid @enderror name="fecha" value="{{ $cita->fecha}}" required autocomplete="fecha" disabled>
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
                                <input id="hora" type="time" class="form-control-plaintext" @error('hora') is-invalid @enderror name="hora" value="{{ $cita->hora}}" required autocomplete="hora" disabled>
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
                                    {{ __('Cancelar Cita') }}
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