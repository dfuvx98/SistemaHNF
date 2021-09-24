<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\enfermedades_preexistentes;
use Illuminate\Http\Request;

class EnfermedadesPreexistentesController extends Controller
{
    //


    public function index(){
        $usuario = Auth::user();
        $enfermedades = enfermedades_preexistentes::all();
        if ($usuario->role == 'cliente') {
            $temEnfermedades = [];
            foreach ($enfermedades as $enfermedad) {
                if (Auth::user()->idPersona == $enfermedad->Paciente->id || Auth::user()->idPersona == $enfermedad->Paciente->idPersona) {
                    array_push($temConsulta, $enfermedad);
                }
            }
            $enfermedad = $temEnfermedades;

            return view('enfermedadesPreexistentes.blade.php',compact('enfermedad'));
        }

    }
}
