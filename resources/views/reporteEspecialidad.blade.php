@extends('layouts.app')

@section('content')

<div class="container my-5">
    <h1>Reporte Especialidad</h1>
</div>

<div class="container table-responsive">
    <table class="table table-bordered table-hover bg-white" id="reporteEspecialidad">
        <thead>
            <tr class="info">
                    <th>Especialidad</th>
                    <th>Total citas</th>
                    <th>Citas Género Masculino</th>
                    <th>Citas género femenino</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($especialidades as $especialidad)
                @if($especialidad->estado==1)
                <tr>
                    <td>{{$especialidad->nombre}}</td>

                <td>
                @php $encontrado =0;
                @endphp
                @foreach ($totalCitas as $totalCita)
                    @if ($totalCita->idEspecialidad == $especialidad->id)
                        {{$totalCita->total}}
                    @php $encontrado =1;
                    @endphp
                    @else
                    @endif
                @endforeach
                @if ($encontrado==0)
                    {{0}}
                @endif
                </td>
                <td>
                @php $encontrado =0;
                @endphp
                @foreach ($totalCitasGenero as $citaMasculino)
                    @if($citaMasculino->genero == 'Masculino' && $citaMasculino->idEspecialidad == $especialidad->id)
                   {{$citaMasculino->totalCitas}}
                   @php $encontrado =1;
                   @endphp
                    @else
                    @endif
                @endforeach
                @if ($encontrado==0)
                    {{0}}
                @endif
                </td>
                <td>
                @php $encontrado =0;
                @endphp
                @foreach ($totalCitasGenero as $citaFemenino)
                    @if($citaFemenino->genero =='Femenino' && $citaFemenino->idEspecialidad == $especialidad->id)
                   {{$citaFemenino->totalCitas}}
                   @php $encontrado =1;
                   @endphp
                    @else
                    @endif
                @endforeach
                @if ($encontrado==0)
                    {{0}}
                @endif
                </td>
                </tr>
                @else
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
        $('#reporteEspecialidad').DataTable({
    responsive: true,
    autoWidth: false
});
    });
</script>
@endsection