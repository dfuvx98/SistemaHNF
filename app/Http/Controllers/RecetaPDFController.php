<?php

namespace App\Http\Controllers;

use App\Models\Receta;
use Illuminate\Http\Request;
use PDF;
class RecetaPDFController extends Controller
{
    //

    public function obtenerReceta($id){

        $receta = Receta::where('idConsulta', $id)->first();

        return view('recetaPDF',compact('receta'));
    }

    public function downloadPDF($id){

        $receta = Receta::where('idConsulta', $id)->first();
        $pdf = PDF::loadView('recetaPDF', compact('receta'));
        return $pdf->download('receta.pdf');

    }


}
