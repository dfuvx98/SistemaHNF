@extends('layouts.app')

@section('content')


<div class="container my-5">
    <h1>Recetas Médicas</h1>
</div>

<div class="container table-responsive">
    <table class="table table-bordered table-hover bg-white" id="recetas">
        <thead>
            <tr class="info">
                    <th>Fecha</th>
                    <th>Doctor</th>
                    <th>Medicamentos</th>
                    <th>Tratamiento</th>
                    <th>Paciente</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($recetas as $receta)
            @if (Auth::user()->role === 'cliente')
            @if (Auth::user()->idPersona == $receta->Consulta->Cita->Paciente->id || Auth::user()->idPersona == $receta->Consulta->Cita->Paciente->idPersona)
                    <tr>
                        <td>{{$receta->Consulta->fecha}}</td>
                        <td>{{$receta->Consulta->Cita->Medico->nombre}} {{$receta->Consulta->Cita->Medico->apellido}}</td>
                        <td>{{$receta->medicamentos}}</td>
                        <td>{{$receta->tratamiento}}</td>
                        <td>{{$receta->Consulta->Cita->Paciente->nombre}} {{$receta->Consulta->Cita->Paciente->apellido}}</td>
                    </tr>
            @endif
            @else
                    <tr>
                        <td>{{$receta->Consulta->fecha}}</td>
                        <td>{{$receta->Consulta->Cita->Medico->nombre}} {{$receta->Consulta->Cita->Medico->apellido}}</td>
                        <td>{{$receta->medicamentos}}</td>
                        <td>{{$receta->tratamiento}}</td>
                        <td>{{$receta->Consulta->Cita->Paciente->nombre}} {{$receta->Consulta->Cita->Paciente->apellido}}</td>
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
        $('#recetas').DataTable({
    responsive: true,
    autoWidth: false
});
    });
</script>
@endsection
