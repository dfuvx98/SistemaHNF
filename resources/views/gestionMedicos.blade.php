@extends('layouts.app')

@section('content')

<div class="container my-5">
    <h1>Gestión Médicos</h1>
</div>
<div class="container my-5">
    <a class="btn btn-primary btn-lg text-body" href="{{route('medico.create')}}">Registrar Médico</a>
</div>  
<div class="container">
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <tr class="info">
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Cedula</th>
                <th>Usuario</th>
                <th>Email</th>
                <th>Especialidades</th>
                <th>Teléfono</th>
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
                    <td>{{$medico->genero}}</td>
                    <td><a href="{{route('medico.edit', $medico->id)}}">Editar</a></td>
                    <td><a href="{{route('medico.borrar', $medico->id)}}">Borrar</a></td>
                </tr>
            @endforeach
        </table>
    </div>  
    
</div>
@if (request()->get('mensaje'))
    <script>
        alert('{{request()->get('mensaje')}}')
    </script>
@endif
@endsection
