@extends('layouts.app')

@section('content')


<div class="container my-5">
    <h1>Solicitudes de Exámenes</h1>
</div>

<div class="container table-responsive">
    <table class="table table-bordered table-hover bg-white" id="examenes">
        <thead>
            <tr class="info">
                    <th>Fecha</th>
                    <th>Detalle</th>
                    <th>Tipo de examen</th>
                    <th>Doctor</th>
                    <th>Paciente</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($examenes as $examen)
            @if (Auth::user()->role === 'cliente')
            @if (Auth::user()->idPersona == $examen->Consulta->Cita->Paciente->id || Auth::user()->idPersona == $examen->Consulta->Cita->Paciente->idPersona)
                    <tr>
                        <td>{{$examen->Consulta->fecha}}</td>
                        <td>{{$examen->detalle}}</td>
                        <td>{{$examen->Tipo_examen->nombre}}</td>
                        <td>{{$examen->Consulta->Cita->Medico->nombre}} {{$examen->Consulta->Cita->Medico->apellido}}</td>
                        <td>{{$examen->Consulta->Cita->Paciente->nombre}} {{$examen->Consulta->Cita->Paciente->apellido}}</td>
                    </tr>
            @endif
            @else
            <tr>
                <td>{{$examen->Consulta->fecha}}</td>
                <td>{{$examen->detalle}}</td>
                <td>{{$examen->Tipo_examen->nombre}}</td>
                <td>{{$examen->Consulta->Cita->Medico->nombre}} {{$examen->Consulta->Cita->Medico->apellido}}</td>
                <td>{{$examen->Consulta->Cita->Paciente->nombre}} {{$examen->Consulta->Cita->Paciente->apellido}}</td>
            </tr>
            @endif
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
    //seleccionar id de la tabla para que se haga DataTable
    $(document).ready(function() {
        $('#examenes').DataTable({
    responsive: true,
    autoWidth: false
});
    });
</script>
@endsection
