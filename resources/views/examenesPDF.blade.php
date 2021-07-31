<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Receta</title>
</head>
<body>
<style>
    th{
        text-align:left;

    }

    td{

    }

</style>

<h1>Hospital Nuestro Corazón</h1>
<h2>Solicitud de examen</h2>

<div>
    @foreach ($examenes as $examen)
    @if ($loop->first)
    <p>Fecha: {{$examen->Consulta->fecha}}<p>
    <p>Paciente: {{$examen->Consulta->Cita->Paciente->nombre}} {{$examen->Consulta->Cita->Paciente->apellido}} </p>
    <p>Doctor: {{$examen->Consulta->Cita->Medico->nombre}} {{$examen->Consulta->Cita->Medico->apellido}} </p>
    @else
    @endif
    @endforeach
</div>


<table>
    <tr>
        <th>Tipos de examen</th>
    </tr>

    @foreach ($examenes as $examen)
    <tr>
    <td>{{$examen->Tipo_examen->nombre}}</td>
    </tr>
    @endforeach


<table>
    <tr>
        <th>Detalle</th>
    </tr>
    <tr>
        <td>
            @foreach ($examenes as $examen)
                @if ($loop->first)
                    {{$examen->detalle}}
                @else
                @endif
            @endforeach
        </td>
    </tr>
</table>
</body>
</html>
