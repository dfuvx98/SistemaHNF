<?php

namespace App\Http\Controllers;
use App\Models\Persona;
use Illuminate\Http\Request;

class PersonaController extends Controller
{

  
    
    public function mostrarMedicos(){
        $medicos = Persona::where('idTipoPersona', 4)->get();
        return view('gestionMedicos',compact('medicos'));
}

   

    


    

    
}
