<?php

namespace App\Http\Controllers;
use App\Models\Cita;
use App\Models\Persona;
use Illuminate\Http\Request;
use App\Models\Especialidades;
class CitaController extends Controller
{
    //

    public function create(){
        $cita = new Cita();
        $personas = Persona::where('idTipoPersona',2)->orWhere('idTipoPersona',3)->get();
        $especialidades = Especialidades::where('estado',True)->get();
        return view('agendarCitas',compact('cita','personas','especialidades'));
    }

    public function store(Request $request){
        
        $agendada = Cita::where('fecha',$request['fecha'])->where('hora',$request['hora'])->where('idPersonaD',$request['medico'])->where('estado',true)->get();
        
        if( $agendada && count($agendada) > 0){
            return redirect()->route('cita.create');        
        }else{
            Cita::create([
                'idPersonaD' => $request['medico'],
                'idPersonaP' => $request['paciente'],
                'fecha' => $request['fecha'],
                'hora' => $request['hora'],
                'idEspecialidad' => $request['especialidad'],
                'estado'=> '1'
            ]);
            return redirect()->route('cita.index');
        }
        
    }

    public function index(){
        
        $citas=Cita::with('Paciente','Medico','Especialidades')->get();
        

        return view('gestionCitas',compact('citas'));
    }

    public function borrar($id){
        $cita = Cita::with('Paciente','Medico','Especialidades')->findOrFail($id);
        return view ('cancelarCitas',compact('cita'));
    }

    public function borrarCita($id){
        $cita = Cita::with('Paciente','Medico','Especialidades')->findOrFail($id);
        $cita->estado =False;
        if($cita ->save()){
            return redirect()->route('cita.index');
        }else{
        return redirect()->route('citas.borrar');
        }
    }

}
