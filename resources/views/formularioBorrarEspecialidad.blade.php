@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Editar Especialidad</h1>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="post" action="{{ route('especialidades.borrarEspecialidad', $especialidad) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <label for="nombre" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>
                            
                            <div class="col-md-6">
                                <input id="nombre" type="text"  readonly class="form-control-plaintext" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{ $especialidad->nombre }}" required autocomplete="nombre" autofocus>
                                @error('nombre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-danger">
                                    {{ __('Borrar') }}
                                </button>
                                <a class=" button btn btn-primary"href="{{route('especialidades.index')}}">Cancelar</a>        
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
