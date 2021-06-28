<?php

namespace App\Http\Controllers;
use App\Models\Especialidades;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class EspecialidadesController extends Controller
{
    //
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:15']
        ]);
    }

    public function index(){
       $especialidades = Especialidades::all();
       return view ('gestionEspecialidades',compact('especialidades'));
    }

    public function edit ($id){
        $especialidad = Especialidades::findOrFail($id);
        return view ('formularioEditarEspecialidad',compact('especialidad'));
    }

    public function show($id){
        $especialidad = Especialidades::findOrFail($id);
        
    }
    public function update(Request $request, $id){
        $request->validate([
            'nombre' => 'required|unique:especialidades|max:20'
        ],
        [
            'nombre.unique' =>"Ingrese una especialidad que no esté ya ingresada en el sistema",
            'nombre.max' =>"El nombre de la especialidad no puede ser mayor a 20 caracteres"
        ]);
        $especialidad = Especialidades::findOrFail($id);
        $especialidad->fill($request->all());
        if($especialidad ->save()){
            return redirect()->route('especialidades.index');
        }else{
        return redirect()->route('especialidades.update');
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

    public function borrarEspecialidad(Request $request){
        
        $id = $request->id;
        var_dump($id);
        $especialidad = Especialidades::find($id);
        
        $especialidad->estado = false;
        return redirect()->route('especialidades.index');

    }
    
    public function restaurarEspecialidad(Request $request){
        
        $id = $request->id;
        var_dump($id);
        $especialidad = Especialidades::find($id);
        
        $especialidad->estado = false;
        return redirect()->route('especialidades.index');

    }
}
