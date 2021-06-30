<?php

namespace App\Http\Controllers;
use App\Models\Cita;
use Illuminate\Http\Request;

class CitaController extends Controller
{
    //

    public function create(){
        $cita = new Cita();
        return view('agendarCitas',compact('cita'));
    }

}
