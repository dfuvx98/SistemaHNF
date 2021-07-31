<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Solicitud_Examen;
use PDF;
class ExamenPDFController extends Controller
{
    //

    public function obtenerExamenes($id){

        $examenes = Solicitud_Examen::where('idConsulta', $id)->get();
        return view('examenesPDF',compact('examenes'));
    }

    public function downloadPDF($id){

        $examenes = Solicitud_Examen::where('idConsulta', $id)->get();
        $pdf = PDF::loadView('examenesPDF', compact('examenes'));
        return $pdf->download('examen.pdf');

    }

}
