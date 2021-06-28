@extends('layouts.app')

@section('content')

<h1>Gestión Médicos</h1>
<div class="container">
    <table class="table table-bordered table-hover">
        <tr class="info">
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Cedula</th>
            <th>Email</th>
            <th>Teléfono</th>
            <th>Dirección</th>
            <th>Ciudad Residencia</th>
            <th>Fecha de Nacimiento</th>
            <th>Género</th>
        </tr>
        @foreach ($medicos as $medico)
            <tr>
                <td>{{$medico->nombre}}</td>
                <td>{{$medico->apellido}}</td>
                <td>{{$medico->cedula}}</td>
                <td>{{$medico->email}}</td>
                <td>{{$medico->telefono}}</td>
                <td>{{$medico->direccion}}</td>
                <td>{{$medico->ciudadResi}}</td>
                <td>{{$medico->fechaNacimiento}}</td>
                <td>{{$medico->genero}}</td>
            </tr>
        @endforeach
    </table>

    
</div>
@endsection
