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
        $especialidades = Especialidades::all();
        return view('agendarCitas',compact('cita','personas','especialidades'));
    }

    public function index(){
        
        $citas=Cita::with('Paciente','Medico','Especialidades')->get();
        

        return view('gestionCitas',compact('citas'));
    }

    public function borrar($id){
        $cita = Cita::with('Paciente','Medico','Especialidades')->findOrFail($id);
        return view ('cancelarCitas',compact('cita'));
    }
}
