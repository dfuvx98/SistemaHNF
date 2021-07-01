@extends('layouts.app')

@section('content')

<div class="container">

    <h1 class="ml-5">Agendar Citas</h1>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Agendar') }}</div>

                <div class="card-body">
                    <form method="POST">
                        @csrf
                        <div class="form-group row">
                            <label for="paciente" class="col-md-4 col-form-label text-md-right">{{ __('Paciente') }}</label>
                            
                            <div class="col-md-6">
                                <input id="paciente" type="text" class="form-control" @error('paciente') is-invalid @enderror name="paciente" required autocomplete="paciente" autofocus>
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
                                <input id="especialidad" type="text" class="form-control" @error('especialidad') is-invalid @enderror name="especialidad" required autocomplete="especialidad" autofocus>
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
                                <input id="especialidad" type="text" class="form-control" @error('especialidad') is-invalid @enderror name="especialidad" required autocomplete="especialidad" autofocus>
                                @error('especialidad')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="fecha" class="col-md-4 col-form-label text-md-right">{{ __('Fecha') }}</label>
                            
                            <div class="col-md-6">
                                <input id="fecha" type="date" class="form-control" @error('fecha') is-invalid @enderror name="fecha" required autocomplete="fecha" autofocus>
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
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection