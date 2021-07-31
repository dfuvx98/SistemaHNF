@extends('layouts.app')

@section('content')


<div class="container my-5">
    <h1>Historial Medico</h1>
</div>

<div class="container table-responsive">
    <table class="table table-bordered table-hover bg-white" id="historialMedico">
        <thead>
            <tr class="info">
                    <th>Paciente</th>
                    <th>Medico</th>
                    <th>Fecha</th>
                    <th>Sintomas</th>
                    <th>Tratamiento</th>
                    <th>Diagnóstico</th>
                    <th>Medicamentos</th>
                    <th>Posología</th>
                    <th>Tipo De Examen</th>
                    <th>Detalle</th>
                    <th>Generar Receta</th>
                    <th>Generar Examen</th>




            </tr>
        </thead>
        <tbody>
            @foreach ($consultas as $consulta)
            @if (Auth::user()->role === 'cliente')
            @if (Auth::user()->idPersona == $consulta->Cita->Paciente->id || Auth::user()->idPersona == $consulta->Cita->Paciente->idPersona)
                    <tr>
                        <td>{{$consulta->Cita->Paciente->nombre}} {{$consulta->Cita->Paciente->apellido}}</td>
                        <td>{{$consulta->Cita->Medico->nombre}} {{$consulta->Cita->Medico->apellido}} </td>
                        <td>{{$consulta->fecha}}</td>
                        <td>{{$consulta->sintomas}}</td>
                        <td>{{$consulta->tratamiento}}</td>
                        <td>{{$consulta->diagnostico}}</td>
                        @if (isset($consulta->Receta))
                            <td>{{$consulta->Receta->medicamentos}}</td>
                            <td>{{$consulta->Receta->tratamiento}}</td>
                        @else
                            <td></td>
                            <td></td>
                        @endif
                        <td>
                        @if (isset($consulta->Solicitud_Examen))
                        @foreach ($consulta->Solicitud_Examen as $examen)
                        {{$examen->Tipo_examen->nombre}}
                        @endforeach
                        </td>
                        <td>
                        @foreach ($consulta->Solicitud_Examen as $examen)
                        @if ($loop->first)
                        {{$examen->detalle}}
                        @else
                        @endif
                        @endforeach
                        </td>
                        @else
                        </td>
                        <td></td>
                        @endif
                        @if (isset($consulta->Receta))
                            <td><a href="{{route('recetaPDF.descargar', $consulta->id)}}"> Obtener</td>
                        @else
                            <td></td>
                        @endif
                        @if (empty($consulta->Solicitud_Examen))
                            <td><a href="{{route('examenesPDF.descargar', $consulta->id)}}">Obtener</td>
                        @else
                            <td></td>
                        @endif
                    </tr>
            @endif
            @else
                    <tr>
                        <td>{{$consulta->Cita->Paciente->nombre}} {{$consulta->Cita->Paciente->apellido}}</td>
                        <td>{{$consulta->Cita->Medico->nombre}} {{$consulta->Cita->Medico->apellido}} </td>
                        <td>{{$consulta->fecha}}</td>
                        <td>{{$consulta->sintomas}}</td>
                        <td>{{$consulta->tratamiento}}</td>
                        <td>{{$consulta->diagnostico}}</td>
                        @if (isset($consulta->Receta))
                            <td>{{$consulta->Receta->medicamentos}}</td>
                            <td>{{$consulta->Receta->tratamiento}}</td>
                        @else
                            <td></td>
                            <td></td>
                        @endif
                        <td>
                        @if (isset($consulta->Solicitud_Examen))
                        @foreach ($consulta->Solicitud_Examen as $examen)
                        {{$examen->Tipo_examen->nombre}}
                        @endforeach
                        </td>
                        <td>
                        @foreach ($consulta->Solicitud_Examen as $examen)
                        @if ($loop->first)
                        {{$examen->detalle}}
                        @else
                        @endif
                        @endforeach
                        </td>
                        @else
                        </td>
                        <td></td>
                        @endif
                        @if (isset($consulta->Receta))
                            <td><a href="{{route('recetaPDF.descargar', $consulta->id)}}"> Obtener</td>
                        @else
                            <td></td>
                        @endif
                        @if (empty($consulta->Solicitud_Examen))
                            <td><a href="{{route('examenesPDF.descargar', $consulta->id)}}">Obtener</td>
                        @else
                            <td></td>
                        @endif
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
        $('#historialMedico').DataTable({
    responsive: true,
    autoWidth: false
});
    });
</script>
@endsection
