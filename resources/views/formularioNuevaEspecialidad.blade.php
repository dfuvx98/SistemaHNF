@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Registrar Especialidad</h1>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Registrar') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('especialidades.store') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="nombre" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>
                            
                            <div class="col-md-6">
                                <input id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{ old('nombre') }}" required autocomplete="nombre" autofocus>

                                @error('nombre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary text-body">
                                    {{ __('Registrar') }}
                                </button>
                                <a class=" button btn btn-danger"href="{{route('especialidades.index')}}">Cancelar</a>        
                            </div>
                            
                                
                            
                        </div>
                        
                    </form>    
                </div>
               
            </div>
        </div>
    </div>
</div>
@endsection
