@extends('layouts.app')

@section('content')


<div class="container my-5">
    <h1>Gestión Especialidades</h1>
</div>
<div class="container my-5">
    <a class="btn btn-primary btn-lg text-body" href="{{route('especialidades.create')}}">Registrar Especialidad</a>
</div>
<div class="container table-responsive">

    <table class="table table-bordered table-hover bg-white" id="especialidades">
        <thead>
            <tr class="info">

                    <th>Nombre</th>
                    <th>Estado</th>
                    <th>Opciones</th>
            </tr>
        </thead>
        <tbody>
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
                                <a href="{{route('especialidades.edit', $especialidad->id)}}">Editar</a>&nbsp;&nbsp;
                                <a href="{{route('especialidades.borrar', $especialidad->id)}}">Desactivar</a>
                            @endif
                        </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>


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
        $('#especialidades').DataTable({
    responsive: true,
    autoWidth: false
});
    });
</script>
@endsection
