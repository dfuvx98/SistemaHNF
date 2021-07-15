@extends('layouts.app')

@section('content')


<div class="container my-5">
    <h1>Gestión Especialidades</h1>
</div>
<div class="container my-5">
    <a class="btn btn-primary btn-lg text-body" href="{{route('especialidades.create')}}">Registrar Especialidad</a>
</div>
<div class="container">
    
    <table class="table table-bordered table-hover">
        <tr class="info">
            <th>Nombre</th>
            <th>Estado</th>
            <th colspan="2">Opciones</th>            
        </tr>
        @foreach ($especialidades as $especialidad)
            @if ($especialidad)
                <tr>
                    <td>{{$especialidad->nombre}}</td>
                    @if ($especialidad->estado==1)
                    <td>Activo</td>
                    @else
                    <td>Desactivado</td>
                    @endif
                    <td>@if ($especialidad->estado==1)
                            <a href="{{route('especialidades.edit', $especialidad->id)}}">Editar</a></td>
                        @endif
                    <td>@if ($especialidad->estado==1)
                        <a href="{{route('especialidades.borrar', $especialidad->id)}}">Desactivar</a></td>
                        @endif    
                @endif
                
            </tr>
        @endforeach
    </table>


</div>
@endsection
