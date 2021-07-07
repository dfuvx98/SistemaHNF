@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Editar Médico</h1>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Editar') }}</div>
                
                <div class="card-body">
                    <form method="POST" action="{{ route('medico.update', $medico) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <label for="nombre" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>
                            
                            <div class="col-md-6">
                                <input id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{ $medico->nombre}}" required autocomplete="nombre" autofocus>
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
                                <input id="apellido" type="text" class="form-control @error('apellido') is-invalid @enderror" name="apellido" value="{{ $medico->apellido}}" required autocomplete="apellido" autofocus>
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
                                <input id="cedula" type="text" class="form-control @error('cedula') is-invalid @enderror" name="cedula" value="{{ $medico->cedula}}" required autocomplete="cedula" autofocus>
                                @error('cedula')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>                                                        
                        </div>
                        <div class="form-group row">
                            <label for="especialidades" class="col-md-4 col-form-label text-md-right">{{ __('Especialidades') }}</label>
                            <div class="col-md-6">
                                <select class="form-control selection" id="especialidades" name="especialidades[]" multiple="multiple" required >
                                    @if (isSet($especialidades))
                                        @foreach ($especialidades as $especialidad)
                                            @php 
                                                $encontrado = false; 
                                                if (isset($especialidadesMedicos)) {
                                                    foreach ($especialidadesMedicos as $especialidadMedico) {
                                                        if(intval($especialidadMedico->idEspecialidad) == intval($especialidad->id)) { $encontrado = true;}
                                                    }
                                                }
                                            @endphp
                                            @if ($encontrado)
                                                <option value="{{ $especialidad->id}}" selected>{{ $especialidad->nombre}}</option>
                                            @else 
                                                <option value="{{ $especialidad->id}}" >{{ $especialidad->nombre}}</option>
                                            @endif
                                        @endforeach
                                        @else
                                        <option value="0">No existen especialidades</option>        
                                    @endif
                                </select>
                            </div>                                                        
                        </div>



                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>
                            
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $medico->email}}" required autocomplete="email" autofocus>
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
                                <input id="telefono" type="text" class="form-control @error('telefono') is-invalid @enderror" name="telefono" value="{{ $medico->telefono}}" required autocomplete="telefono" autofocus>
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
                                <input id="direccion" type="text" class="form-control @error('direccion') is-invalid @enderror" name="direccion" value="{{ $medico->direccion}}" required autocomplete="direccion" autofocus>
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
                                <input id="ciudadResi" type="text" class="form-control @error('ciudadResi') is-invalid @enderror" name="ciudadResi" value="{{ $medico->ciudadResi}}" required autocomplete="ciudadResi" autofocus>
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
                                <input id="fechaNacimiento" type="date" class="form-control @error('fechaNacimiento') is-invalid @enderror" name="fechaNacimiento" value="{{ $medico->fechaNacimiento}}" required autocomplete="fechaNacimiento" autofocus>
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
                                <select name="genero" id="genero" class="form-control">
                                    @if ($medico->genero=='Masculino')    
                                        <option value="Masculino" selected>Masculino</option>    
                                        <option value="Femenino">Femenino</option>    
                                    @else    
                                        <option value="Masculino">Masculino</option>    
                                        <option value="Femenino" selected>Femenino</option>    
                                    @endif    
                                </select>
                            </div>                                                        
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Editar') }}
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
    $('#especialidades').select2();
</script>
@endsection

