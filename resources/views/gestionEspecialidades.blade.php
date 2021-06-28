@extends('layouts.app')

@section('content')

<h1 class="ml-5">Gestión Especialidades</h1>
<div class="container">
    <table class="table table-bordered table-hover">
        <tr class="info">
            <th>Nombre</th>
        </tr>
        @foreach ($especialidades as $especialidad)
            <tr>
                <td>{{$especialidad->nombre}}</td>
                @if ($especialidad->estado==1)
                <td>Activo</td>
                @else
                <td>Desactivado</td>    
                @endif
                <td><a href="{{route('especialidades.edit', $especialidad->id)}}">Editar</a></td>
                <td><a href="{{route('borrarEspecialidad', $especialidad->id)}}" method="POST">Borrar</a></td>
            </tr>
        @endforeach
    </table>

    <a class="btn btn-primary"href="{{route('especialidades.create')}}">Registrar Especialidad</a>
</div>
@endsection
