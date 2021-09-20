<?php

namespace App\Http\Controllers;
use App\Models\Cita;
use App\Models\Persona;
use Illuminate\Http\Request;
use App\Models\Especialidades;
use App\Models\Tipo_examen;
use Illuminate\Support\Facades\Auth;

class CitaController extends Controller
{
    

    public function agendarCita(Request $request) {

        $agendada = Cita::where('fecha',$request['fecha'])->where('hora',$request['hora'])->where('idPersonaD',$request['medico'])->where('estado',1)->get();
        $objeto = [];
        if( $agendada && count($agendada) > 0){
            $objeto['error'] = 'Error: ya existe una cita con este medico en la hora y fecha fijada';
            return response()->json($objeto);
        }else{
            $citaTemp = Cita::create([
                'idPersonaD' => $request['medico'],
                'idPersonaP' => $request['paciente'],
                'fecha' => $request['fecha'],
                'hora' => $request['hora'],
                'idEspecialidad' => $request['especialidad'],
                'estado'=> '1'
            ]);
            $cita = Cita::with('Paciente','Medico','Especialidades')->where('citas.id', $citaTemp->id)->get();
            $objeto['success'] = 'Se agendo la cita con exito';
            $objeto['cita'] = $cita[0];
            return response()->json($objeto);
        }
    }

   

    public function index(){
        if(Auth::user()){
            $cita = new Cita();
            $usuario = Auth::user();
            $personas = null;
            if ($usuario->role == 'administrador')  {
                $personas = Persona::where('idTipoPersona',2)->orWhere('idTipoPersona',3)->get();
            }
            elseif($usuario->role == 'cliente') {
                $personas = Persona::where('id', $usuario->idPersona)->orWhere('idPersona',$usuario->idPersona)->get();
            }
            $especialidades = Especialidades::where('estado',True)->get();
            $tiposExamenes = Tipo_examen::all();
            return view('gestionCitas',compact('cita','personas','especialidades','tiposExamenes'));
        }
        return redirect('/login');
    }

    public function obtenerCitas(){
        if(Auth::user()){
            $usuario = Auth::user();
            if ($usuario->role == 'administrador')  {
                $citas = Cita::with('Paciente','Medico','Especialidades')->get();
            }
            elseif ($usuario->role == 'medico') {
                $citas = Cita::with('Paciente','Medico','Especialidades')->where('idPersonaD', $usuario->idPersona)->get();
            }
            else {
                $citas = Cita::with('Paciente','Medico','Especialidades')->where('idPersonaP', $usuario->idPersona)->get();
                $personas = Persona::where('idPersona',$usuario->idPersona)->get();
                foreach ($personas as $persona) {
                    $citas2 = Cita::with('Paciente','Medico','Especialidades')->where('idPersonaP', $persona->id)->get();
                    foreach ($citas2 as $citapaciente) {
                        $citas->push($citapaciente);
                    }
                }
            }
            return response()->json($citas);
        }
        $objeto = [];
        $objeto['error'] = 'Error al obtener citas';
        return response()->json($objeto);
    }

    /*public function borrar($id){
        $cita = Cita::with('Paciente','Medico','Especialidades')->findOrFail($id);
        return view ('cancelarCitas',compact('cita'));
    }*/

    public function borrarCita(Request $request){
        $cita = Cita::find($request['id_cita']);
        $objeto = [];
        if($cita){
            $cita->estado =0;
            $cita->save();
            $objeto['success'] = 'Se cancelo la cita con exito';
            $objeto['cita'] = $cita;
            return response()->json($objeto);
        }else{
            $objeto['error'] = 'No se encontro cita a editar';
            return response()->json($objeto);
        }
    }

}
