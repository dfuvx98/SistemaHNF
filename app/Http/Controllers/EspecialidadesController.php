<?php

namespace App\Http\Controllers;
use App\Models\Especialidades;
use Illuminate\Http\Request;
use App\Models\Persona_especialidad;
use App\Models\Persona;
use Illuminate\Support\Facades\Validator;
class EspecialidadesController extends Controller
{
    //
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:15','alpha']
        ]);
    }

    public function index(){
       $especialidades = Especialidades::all();
       return view ('gestionEspecialidades',compact('especialidades'));
    }

    public function edit ($id){
        $especialidad = Especialidades::findOrFail($id);
        if($especialidad->estado !=false){
            return view ('formularioEditarEspecialidad',compact('especialidad'));
        }
        else return back();
        
    }

    public function show($id){
        $especialidad = Especialidades::findOrFail($id);

    }
    public function update(Request $request, $id){
        $request->validate([
            'nombre' => 'required|unique:especialidades|max:20|alpha'
        ],
        [
            'nombre.unique' =>"Ingrese una especialidad que no esté ya ingresada en el sistema",
            'nombre.max' =>"El nombre de la especialidad no puede ser mayor a 20 caracteres",
            'nombre.alpha'=>"El nombre de la especialidad no puede contener números"
        ]);
        $especialidad = Especialidades::findOrFail($id);
        $especialidad->fill($request->all());
        if($especialidad ->save()){
            return redirect()->route('especialidades.index');
        }else{
        return redirect()->route('especialidades.edit');
        }
    }

    public function create(){
        $especialidad = new Especialidades;
        return view('formularioNuevaEspecialidad',compact('especialidad'));
    }

    public function store(Request $request){

        $request->validate([
            'nombre' => 'required|unique:especialidades|max:20'
        ],
        [
            'nombre.unique' =>"Ingrese una especialidad que no esté ya ingresada en el sistema",
            'nombre.max' =>"El nombre de la especialidad no puede ser mayor a 20 caracteres"
        ]);
        $especialidad = new Especialidades;
        $especialidad->fill($request->all());

        if($especialidad ->save()){
            return redirect()->route('especialidades.index');
        }else{
            return redirect()->route('especialidades.create');
        }

    }

    public function borrar($id){
        $especialidad = Especialidades::findOrFail($id);
        return view ('formularioDesactivarEspecialidad',compact('especialidad'));
    }

    public function borrarEspecialidad($id){
        $especialidad = Especialidades::findOrFail($id);
        $especialidad->estado =False;
        if($especialidad ->save()){
            return redirect()->route('especialidades.index');
        }else{
        return redirect()->route('especialidades.borrar');
        }
    }

    public function obtenerMedicos($id){
        $person_espe = Persona_especialidad::where('idEspecialidad', $id)->get();
        $array = [];
        try {
            foreach($person_espe as $person){
                if($person->idPersona){
                    $persona = Persona::where('estado', 1)->findOrFail($person->idPersona);
                    if($persona){
                        array_push($array,$persona);
                    }
                }
            }
        } catch (\Throwable $th) {
            //throw $th;
        }

        return response()->json($array);
    }

}
