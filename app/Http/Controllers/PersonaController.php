<?php

namespace App\Http\Controllers;
use App\Models\Persona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class PersonaController extends Controller
{

  
    
    public function mostrarMedicos(){
        $medicos = Persona::where('idTipoPersona', 4)->where('estado',True)->get();
        return view('gestionMedicos',compact('medicos'));
    }

    public function editarMedico($id){
        $medico = Persona::findOrFail($id);
        return view ('formularioEditarMedico',compact('medico'));
    }


    public function crearMedico(){
        $medico = new Persona;
        return view('formularioNuevoMedico',compact('medico'));
    }


    public function guardarMedico(Request $request){    
        
        $medico= Persona::create([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'cedula' => $request->cedula,
            'email' => $request->email,
            'telefono' =>$request->telefono,
            'direccion' =>$request->direccion,
            'ciudadResi' =>$request->ciudadResi,
            'fechaNacimiento' =>$request->fechaNacimiento,
            'genero' =>$request->genero,
            'estado'=> '1',
            'idTipoPersona'=>'4'
        ]);

        User::create([
            'name' => 'D'.$request->cedula,
            'surname' => $request->apellido,
            'email' => $request->email,
            'nick' => 'nick',
            'password' => Hash::make('D'.$request->cedula),
            'role' => 'medico',
            'idPersona'=> $medico->id
        ]);
        
        

        return redirect()->route('personaMostrarMedicos');
    }


    public function updateMedico(Request $request, $id){
        $medico = Persona::findOrFail($id);
        
        $medico->fill($request->all());
        if($medico ->save()){
            return redirect()->route('personaMostrarMedicos');
        }else{
        return redirect()->route('medico.edit');
        }
    }

    public function borrarMedico($id){
        $medico = Persona::findOrFail($id);
        return view ('formularioBorrarMedico',compact('medico'));
    }
    
    public function deleteMedico($id){
        $medico = Persona::findOrFail($id);
        $medico->estado =False;
        $personaID = $medico->id;
        $user = User::where('idPersona', $personaID)->firstOrFail();
        $user->estado =False;
        if($medico ->save() && $user->save()){
            return redirect()->route('personaMostrarMedicos');
        }else{
        return redirect()->route('medico.borrar');
        }
        
    }
    
}
