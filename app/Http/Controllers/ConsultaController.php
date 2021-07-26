<?php

namespace App\Http\Controllers;
use App\Models\Consulta;
use App\Models\Solicitud_Examen;
use App\Models\Receta;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class ConsultaController extends Controller
{
    //

    public function guardar(Request $request){

        if(Auth::user() && Auth::user()->role == 'medico')  {
            $consulta = new Consulta();
            $consulta->sintomas = $request['sintomas'];
            $consulta->tratamiento = $request['tratamiento'];
            $consulta->diagnostico = $request['diagnostico'];

            //$consulta->save();
            if($request['solicitaExamenes'] === 'si') {
                $detalleExamen = $request['detalleExamen'];
                if (count($request['tiposExamenes']) > 0) {
                    foreach($request['tiposExamenes'] as $tipoExamen) {
                        $examen = new Solicitud_Examen();
                        $examen->idConsulta = $consulta->id;
                        $examen->detalle = $detalleExamen;
                        $examen->idTipo = $tipoExamen;
                        //$examen->save();
                    }
                }
            }
            if($request['medicamento_receta'] !== '' && $request['tratamiento_receta'] !== '') {
                $receta = new Receta();
                $receta->idConsulta = $consulta->id;
                $receta->medicamentos = $request['medicamento_receta'];
                $receta->tratamiento = $request['tratamiento_receta'];
               //$receta->save();
            }

            //return view('gestionCitas',compact('cita','personas','especialidades','tiposExamenes'));
        }
        return response()->json($request);
    }
}
