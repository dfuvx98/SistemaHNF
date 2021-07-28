<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Solicitud_Examen;
class SolicitudExamenController extends Controller
{
    //

    public function index(){
        $examenes = Solicitud_Examen::all();
        return view ('examenes',compact('examenes'));
    }
}
