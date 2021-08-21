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
                    <th>1-10</th>
                    <th>11-20</th>
                    <th>21-30</th>
                    <th>31-40</th>
                    <th>41-50</th>
                    <th>50+</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($especialidades as $especialidad)
                @if($especialidad->estado==1)
                <tr>
                    <td>{{$especialidad->nombre}}</td>

                <td>
                @foreach ($totalCitas as $totalCita)
                    @if ($totalCita->idEspecialidad == $especialidad->id)
                        {{$totalCita->total}}
                    @else
                    @endif

                @endforeach
                </td>
                <td>
                @foreach ($rangoEdades as $rangoEdad)
                    @if($rangoEdad->idEspecialidad == $especialidad->id && $rangoEdad->rangoEdades=='1-10')
                    {{$rangoEdad->total}}
                    @else
                    @endif
                @endforeach
                </td>
                <td>
                @foreach ($rangoEdades as $rangoEdad)
                    @if($rangoEdad->idEspecialidad == $especialidad->id && $rangoEdad->rangoEdades=='11-20')
                   {{$rangoEdad->total}}
                    @else
                    @endif
                @endforeach
                </td>
                <td>
                @foreach ($rangoEdades as $rangoEdad)
                    @if($rangoEdad->idEspecialidad == $especialidad->id && $rangoEdad->rangoEdades=='21-30')
                   {{$rangoEdad->total}}
                    @else
                    @endif
                @endforeach
                </td>
                <td>
                @foreach ($rangoEdades as $rangoEdad)
                    @if($rangoEdad->idEspecialidad == $especialidad->id && $rangoEdad->rangoEdades=='31-40')
                   {{$rangoEdad->total}}
                    @else
                    @endif
                @endforeach
                </td>
                <td>
                @foreach ($rangoEdades as $rangoEdad)
                    @if($rangoEdad->idEspecialidad == $especialidad->id && $rangoEdad->rangoEdades=='41-50')
                   {{$rangoEdad->total}}
                    @else
                    @endif
                @endforeach
                </td>
                <td>
                @foreach ($rangoEdades as $rangoEdad)
                    @if($rangoEdad->idEspecialidad == $especialidad->id && $rangoEdad->rangoEdades=='50+')
                   {{$rangoEdad->total}}
                    @else
                    @endif
                @endforeach
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
