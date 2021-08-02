@extends('layouts.app')

@section('content')


<div class="container">
    <h1>Registro de paciente</h1>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Registro Paciente') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('paciente.store') }}">
                        @csrf
                        @if (Auth::user()->role === 'administrador')
                        <div class="form-group row">
                            <label for="cliente" class="col-md-4 col-form-label text-md-right">{{ __('Cliente') }}</label>
                            <div class="col-md-6">
                                <select class="form-control selection" id="cliente" name="cliente" required>
                                    @if (isSet($clientes))
                                        @foreach ($clientes as $cliente)
                                            <option value="{{ $cliente->id}}">{{ $cliente->nombre}} {{ $cliente->apellido}}</option>
                                        @endforeach
                                        @else
                                        <option value="0">No existen clientes</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        @else
                        <div class="form-group row" style="display: none">
                            <label for="cliente" class="col-md-4 col-form-label text-md-right">{{ __('Cliente') }}</label>
                            <div class="col-md-6">
                                 <input type="text" class="form-control selection" id="cliente" name="cliente" style="display: none" value="{{ $clientes['0']->id}}" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="cliente" class="col-md-4 col-form-label text-md-right">{{ __('Cliente') }}</label>
                            <div class="col-md-6">
                                 <input type="text" class="form-control selection" id="clienteNombre" name="clienteNombre" value="{{ $clientes['0']->nombre}} {{ $clientes['0']->apellido}}" readonly>
                            </div>
                        </div>

                        @endif
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" @error('name') is-invalid @enderror name="name" value="{{ old('name') }}" required autocomplete="off" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="surname" class="col-md-4 col-form-label text-md-right">{{ __('Apellido') }}</label>

                            <div class="col-md-6">
                                <input id="surname" type="text" class="form-control" @error('surname') is-invalid @enderror name="surname" value="{{ old('surname') }}" required autocomplete="surname" autofocus>

                                @error('surname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="cedula" class="col-md-4 col-form-label text-md-right">{{ __('Cédula') }}</label>

                            <div class="col-md-6">
                                <input id="cedula" type="text" class="form-control" @error('cedula') is-invalid @enderror name="cedula" value="{{ old('cedula') }}" required autocomplete="cedula" autofocus>

                                @error('cedula')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Correo Electrónico') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" @error('email') is-invalid @enderror name="email" value="{{ old('email') }}" autocomplete="email">

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
                                <input id="telefono" type="text" class="form-control" @error('telefono') is-invalid @enderror name="telefono" value="{{ old('telefono') }}" autocomplete="telefono" autofocus>

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
                                <input id="direccion" type="text" class="form-control" @error('direccion') is-invalid @enderror name="direccion" value="{{ old('direccion') }}" required autocomplete="direccion" autofocus>

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
                                <input id="ciudadResi" type="text" class="form-control" @error('ciudadResi') is-invalid @enderror name="ciudadResi" value="{{ old('coudadResi') }}" required autocomplete="ciudadResi" autofocus>

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
                                <input id="fechaNacimiento" type="date" max="3030-12-30" class="form-control @error('fechaNacimiento') is-invalid @enderror" name="fechaNacimiento" value="{{ old('fechaNacimiento') }}" required autocomplete="fechaNacimiento" autofocus>

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
                                    <option value="Masculino">Masculino</option>
                                    <option value="Femenino">Femenino</option>
                                  </select>
                            </div>
                        </div>






                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Registrar') }}
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
    if({!!Auth::user()->role =='administrador'!!}){
        $('#cliente').select2();
    };
</script>
@endsection
