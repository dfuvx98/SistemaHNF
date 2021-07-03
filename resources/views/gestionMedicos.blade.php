@extends('layouts.app')

@section('content')

<h1 class="ml-5">Gestión Médicos</h1>
<div class="container">
    <div class="container my-5">
        <a class="btn btn-primary btn-lg text-body" href="{{route('medico.create')}}">Registrar Médico</a>
    </div>    
    <table class="table table-bordered table-hover">
        <tr class="info">
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Cedula</th>
            <th>Usuario</th>
            <th>Email</th>
            <th>Especialidades</th>
            <th>Teléfono</th>
            <th>Dirección</th>
            <th>Ciudad Residencia</th>
            <th>Fecha de Nacimiento</th>
            <th>Género</th>
            <th colspan="2">Opciones</th>
        </tr>
        @foreach ($medicos as $key=>$medico)
            <tr>
                <td>{{$medico->nombre}}</td>
                <td>{{$medico->apellido}}</td>
                <td>{{$medico->cedula}}</td>
                <td>{{$medico->Users->name}}</td>
                <td>{{$medico->email}}</td>
                <td>
                    @foreach ($medico->Persona_especialidad as $especialidad)
                        {{$medico->Persona_especiaidad}}
                        {{$especialidad->nombre}}
                    @endforeach
                </td>
                <td>{{$medico->telefono}}</td>
                <td>{{$medico->direccion}}</td>
                <td>{{$medico->ciudadResi}}</td>
                <td>{{$medico->fechaNacimiento}}</td>
                <td>{{$medico->genero}}</td>
                <td><a href="{{route('medico.edit', $medico->id)}}">Editar</a></td>
                <td><a href="{{route('medico.borrar', $medico->id)}}">Borrar</a></td>
            </tr>
        @endforeach
    </table>

    
</div>
@endsection
