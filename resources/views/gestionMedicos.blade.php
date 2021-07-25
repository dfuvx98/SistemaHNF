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
        <table class="table table-bordered table-hover bg-white" id="medicos">
            <thead>
                <tr class="info">
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Cedula</th>
                    <th>Usuario</th>
                    <th>Email</th>
                    <th>Especialidades</th>
                    <th>Teléfono</th>
                    <th>Género</th>
                    <th style="width: 20%">Opciones</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($medicos as $medico)
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
                        <td><a href="{{route('medico.edit', $medico->id)}}">Editar</a> &nbsp;&nbsp;
                        <a href="{{route('medico.borrar', $medico->id)}}">Borrar</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
@endsection
@section('js_extras')
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js" defer></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js" defer></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js" defer></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap4.min.js" defer></script>
<script>
    $(document).ready(function() {
        $('#medicos').DataTable({
    responsive: true,
    autoWidth: false
});
    });
</script>
@if (request()->get('mensaje'))
    <script>
        alert('{{request()->get('mensaje')}}')
    </script>
@endif

@endsection




