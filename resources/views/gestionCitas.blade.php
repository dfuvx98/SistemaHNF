@extends('layouts.app')

@section('content')

<h1 class="ml-5">Gestionar Citas</h1>
<div class="container">
    <div class="container my-5">
        <a class="btn btn-primary btn-lg text-body" href="{{route('medico.create')}}">Registrar Médico</a>
    </div>    
    <table class="table table-bordered table-hover">
        <tr class="info">
            <th>Paciente</th>
            <th>Doctor</th>
            <th>Hora </th>
            <th>Fecha</th>
            <th>Especialidad</th>
            <th>Estado</th>
            <th>Opción</th>
        </tr>
        @foreach ($citas as $cita)
            <tr>
                <td>{{$cita->idPersonaP}}</td>
                <td>{{$cita->idPersonaD}}</td>
                <td>{{$cita->hora}}</td>
                <td>{{$cita->fecha}}</td>
                <td>{{$cita->idEspecialidad}}</td>
                   
            </tr>
        @endforeach
    </table>

    
</div>
@endsection
