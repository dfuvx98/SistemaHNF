@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Registrar Médico</h1>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Registrar') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('medico.store') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="nombre" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>
                            
                            <div class="col-md-6">
                                <input id="nombre" type="text" class="form-control" @error('nombre') is-invalid @enderror name="nombre" required autocomplete="nombre" autofocus>
                                @error('nombre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>                                                        
                        </div>

                        <div class="form-group row">
                            <label for="apellido" class="col-md-4 col-form-label text-md-right">{{ __('Apellido') }}</label>
                            
                            <div class="col-md-6">
                                <input id="apellido" type="text" class="form-control" @error('apellido') is-invalid @enderror name="apellido" required autocomplete="apellido" autofocus>
                                @error('apellido')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>                                                        
                        </div>


                        <div class="form-group row">
                            <label for="cedula" class="col-md-4 col-form-label text-md-right">{{ __('Cédula') }}</label>
                            
                            <div class="col-md-6">
                                <input id="cedula" type="text" class="form-control" @error('cedula') is-invalid @enderror name="cedula" required autocomplete="cedula" autofocus>
                                @error('cedula')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>                                                        
                        </div>
                        
                        <div class="form-group row">
                            <label for="especialidad" class="col-md-4 col-form-label text-md-right">{{ __('Especialidades') }}</label>
                            <div class="col-md-6">
                                <input id="especialidad" type="text" class="form-control"  @error('especialidad') is-invalid @enderror name="especialidad" required autocomplete="especialidad" autofocus>
                                
                                @error('especialidad')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>                                                        
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>
                            
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" @error('email') is-invalid @enderror name="email" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>                                                        
                        </div>

                        <div class="form-group row">
                            <label for="telefono" class="col-md-4 col-form-label text-md-right">{{ __('Teléfono') }}</label>
                            
                            <div class="col-md-6">
                                <input id="telefono" type="text" class="form-control" @error('telefono') is-invalid @enderror name="telefono" required autocomplete="telefono" autofocus>
                                @error('telefono')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>                                                        
                        </div>

                        <div class="form-group row">
                            <label for="direccion" class="col-md-4 col-form-label text-md-right">{{ __('Dirección') }}</label>
                            
                            <div class="col-md-6">
                                <input id="direccion" type="text" class="form-control" @error('direccion') is-invalid @enderror name="direccion" required autocomplete="direccion" autofocus>
                                @error('direccion')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>                                                        
                        </div>

                        <div class="form-group row">
                            <label for="ciudadResi" class="col-md-4 col-form-label text-md-right">{{ __('Ciudad de Residencia') }}</label>
                            
                            <div class="col-md-6">
                                <input id="ciudadResi" type="text" class="form-control" @error('ciudadResi') is-invalid @enderror name="ciudadResi" required autocomplete="ciudadResi" autofocus>
                                @error('ciudadResi')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>                                                        
                        </div>

                        <div class="form-group row">
                            <label for="fechaNacimiento" class="col-md-4 col-form-label text-md-right">{{ __('Fecha de Nacimiento') }}</label>
                            
                            <div class="col-md-6">
                                <input id="fechaNacimiento" type="date" class="form-control" @error('fechaNacimiento') is-invalid @enderror name="fechaNacimiento" required autocomplete="fechaNacimiento" autofocus>
                                @error('fechaNacimiento')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>                                                        
                        </div>

                        <div class="form-group row">
                            <label for="genero" class="col-md-4 col-form-label text-md-right">{{ __('Genero') }}</label>
                            
                            <div class="col-md-6">
                                <input id="genero" type="text" class="form-control" @error('genero') is-invalid @enderror name="genero" required autocomplete="genero" autofocus>
                                @error('genero')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>                                                        
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Registrar') }}
                                </button>
                                <a class=" button btn btn-danger"href="{{route('personaMostrarMedicos')}}">Cancelar</a>           
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('especialidad').select2({
      width: '100%',
      placeholder: "Select an Option",
      allowClear: true
    });
  </script>
@endsection
