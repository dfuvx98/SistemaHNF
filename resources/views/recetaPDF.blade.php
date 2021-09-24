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

    #piePagina{
        font-weight: bold;
    }

</style>
<h1>Hospital Nuestro Corazón</h1>
<h2>Receta Médica</h2>

<div>
    <p>Fecha: {{$receta->Consulta->fecha}}<p>
    <p>Paciente: {{$receta->Consulta->Cita->Paciente->nombre}} {{$receta->Consulta->Cita->Paciente->apellido}} </p>
    <p>Doctor: {{$receta->Consulta->Cita->Medico->nombre}} {{$receta->Consulta->Cita->Medico->apellido}} </p>
</div>


<table>
    <thead>
        <tr>
            <th>Medicamentos</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{$receta->medicamentos}}</td>
        </tr>
    </tbody>
    </table>
<table>
    <thead>
        <tr>
            <th>Posología</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{$receta->tratamiento}}</td>
        </tr>
    </tbody>
</table>
<div>
    <p><span id= piePagina>Receta generada por:</span> {{Auth::user()->Persona->nombre}} {{Auth::user()->Persona->apellido}} en {{ date('Y-m-d H:i:s') }}</p>
   
</div>

</body>
</html>
