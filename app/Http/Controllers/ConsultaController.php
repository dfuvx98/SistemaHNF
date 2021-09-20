<?php

namespace App\Http\Controllers;
use App\Models\Consulta;
use App\Models\Solicitud_Examen;
use App\Models\Receta;
use App\Models\Cita;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
class ConsultaController extends Controller
{
    //

    public function guardar(Request $request){


        $validator = Validator::make($request->all(),[
            'sintomas' => 'required',
            'tratamiento' =>'required',
            'diagnostico' =>'required',
            'fechaControl'=>'required',
            'fecha' => 'required',
            'hora' =>'required',
        ],[
            'sintomas.required' =>"Ingrese sintomas del paciente",
            'tratamiento.required' =>"Ingrese el tratamiento del paciente",
            'diagnostico.required' =>"Ingrese el diagnostico del paciente",
            'fecha_proximo_control.required' =>"Ingrese la fecha del proximo control"
        ]);
        if(($validator->fails())){
            return response()->json(['error'=>$validator->errors()]);
        }
        else{
            if(Auth::user() && Auth::user()->role == 'medico')  {
                $consulta = Consulta::create([
                    'idCita' => $request['idCita'],
                    'sintomas' => $request['sintomas'],
                    'tratamiento'=> $request['tratamiento'],
                    'diagnostico'=> $request['diagnostico'],
                    'fecha_proximo_control'=> $request['fechaControl'],
                    'fecha'=> $request['fecha'],
                    'hora'=> $request['hora']
                ]);
                if($request['solicitaExamenes'] === 'si') {
                    $detalleExamen = $request['detalleExamen'];
                    if (count($request['tiposExamenes']) > 0 && $detalleExamen!==null) {
                        foreach($request['tiposExamenes'] as $tipoExamen) {
                            $examen = Solicitud_Examen::create([
                                'idConsulta' => $consulta->id,
                                'detalle' => $detalleExamen,
                                'idTipo' => $tipoExamen
                            ]);

                        }
                    }
                }

                if($request['medicamento_receta'] !== null && $request['tratamiento_receta'] !== null) {
                    $receta = Receta::create([
                        'medicamentos' => $request['medicamento_receta'],
                        'tratamiento' => $request['tratamiento_receta'],
                        'idConsulta' => $consulta->id
                    ]);
                }

            }
        }
        $cita = Cita::find($request['idCita']);
        if($cita){
          $cita->estado =2;
            $cita->save();
        }else{
            $mensaje= 'No se pudo cambiar estado de cita a realizada';
            return response()->json([$mensaje]);
    }
        $mensaje='Se registro la consulta con exito';
        return response()->json([$mensaje]);
    }

    public function index(){
        $usuario = Auth::user();
        $consultas =  $consultas = Consulta::all();
        if ($usuario->role == 'cliente') {
            $temConsulta = [];
            foreach ($consultas as $consulta) {
                if (Auth::user()->idPersona == $consulta->Cita->Paciente->id || Auth::user()->idPersona == $consulta->Cita->Paciente->idPersona) {
                    array_push($temConsulta, $consulta);
                }
            }
            $consultas = $temConsulta;
        }

        return view ('historialMedico',compact('consultas'));
    }
}
