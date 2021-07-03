@extends('layouts.app')

@section('content')


<div class="container">
    <h1 class="ml-5">Gestionar Citas</h1>
    <div class="container my-5">
        <a class="btn btn-primary btn-lg text-body" href="{{route('cita.create')}}">Agendar cita</a>
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
       

        
        @foreach ($citas as $key=>$cita)
            <tr>
                <td>{{$cita->Paciente->nombre}}</td>
                <td>{{$cita->Medico->nombre}}</td>
                <td>{{$cita->hora}}</td>
                <td>{{$cita->fecha}}</td>
                <td>{{$cita->Especialidades->nombre}}</td>
                @if ($cita->estado==1)
                <td>Agendada</td>
                @else
                <td>Cancelada</td>
                @endif
                <td>@if ($cita->estado==1)
                    <a href="{{route('cita.borrar', $cita->id)}}">Cancelar</a></td>
                @endif
                   
            </tr>
        @endforeach
    </table>

    
</div>
@endsection
