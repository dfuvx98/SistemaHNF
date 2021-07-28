<?php

namespace App\Http\Controllers;
use App\Models\Receta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class RecetaController extends Controller
{
    //

    public function index(){
        $recetas = Receta::all();
        return view ('recetas',compact('recetas'));
    }
/*
    public function recetasCliente(){
        $usuario = Auth::user();
        $recetas = $recetas->Consulta->fecha;
        $recetas3 = Receta::where('id', $usuario->idPersona)->orWhere('idPersona',$usuario->idPersona)->get();

        return view ('recetas',compact('recetas'));
    }
    */
}
