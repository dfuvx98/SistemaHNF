@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Bienvenido') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    {{ __('Bienvenido al Sistema de Hospital Nuestro Corazón ') }}
                </div>
            </div>
        </div>
    </div>
</div>
@if (request()->get('mensaje'))
    <script>
        alert('{{request()->get('mensaje')}}')
    </script>
@endif
@endsection
