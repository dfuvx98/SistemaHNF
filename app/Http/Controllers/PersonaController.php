<?php

namespace App\Http\Controllers;
use App\Models\Persona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Especialidades;
use App\Models\Persona_Especialidad;

class PersonaController extends Controller
{

  
    
    public function mostrarMedicos(){
        $medicos = Persona::where('idTipoPersona', 4)->where('estado',True)->with('Users')->get();
        
        return view('gestionMedicos',compact('medicos'));
    }

    public function editarMedico($id){
        $medico = Persona::findOrFail($id);
        $especialidades = Especialidades::where('estado',True)->get();
        $especialidadesMedicos = Persona_Especialidad::where('idPersona',$medico->id)->get();
        return view ('formularioEditarMedico',compact('medico','especialidades','especialidadesMedicos'));
    }


    public function crearMedico(){
        $medico = new Persona;
        $especialidades = Especialidades::where('estado',True)->get();
        return view('formularioNuevoMedico',compact('medico','especialidades'));
    }


    public function guardarMedico(Request $request){  
        $especialidades = $request->especialidad;
        
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
        $usuario = User::create([
            'name' => 'D'.$request->cedula,
            'email' => $request->email,
            'password' => Hash::make('D'.$request->cedula),
            'role' => 'medico',
            'idPersona'=> $medico->id
        ]);
        for ($i=0; $i < count($especialidades); $i++){
            Persona_Especialidad::create([
                'idPersona'=> $medico->id,
                'idEspecialidad' => $especialidades[$i]
            ]);
        }
        $mensaje = 'Se creó el medico '.$medico->nombre.' '.$medico->apellido.' con usuario '. $usuario->name;

        return redirect()->route('personaMostrarMedicos',['mensaje'=>$mensaje]);
    }


    public function updateMedico(Request $request, $id){
        $medico = Persona::findOrFail($id);
        $medico->fill($request->all());
        if($medico ->save()){
            Persona_Especialidad::where('idPersona', $medico->id)->delete();
            $especialidades = $request->especialidades;
            for ($i=0; $i < count($especialidades); $i++){
                Persona_Especialidad::create([
                    'idPersona'=> $medico->id,
                    'idEspecialidad' => $especialidades[$i]
                ]);
            }
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

    public function crearCliente(){
        $cliente = new Persona;
        return view('formularioNuevoCliente',compact('cliente'));
    }


    protected function storeCliente(Request $request)
    {        
        $cliente= Persona::create([
            'nombre' => $request['name'],
            'apellido' => $request['surname'],
            'cedula' => $request['cedula'],
            'email' => $request['email'],
            'telefono' =>$request['telefono'],
            'direccion' =>$request['direccion'],
            'ciudadResi' =>$request['ciudadResi'],
            'fechaNacimiento' =>$request['fechaNacimiento'],
            'genero' =>$request['genero'],
            'estado'=> '1',
            'idTipoPersona'=>'2'
        ]);
        $usuario= User::create([
            'name' => 'C'.$request['cedula'],
            'email' => $request['email'],
            'password' => Hash::make('C'.$request['cedula']),
            'role' => 'cliente',
            'idPersona'=> $cliente->id
        ]);
        $mensaje = 'Se creó el cliente '.$cliente->nombre.' '.$cliente->apellido.' con usuario '. $usuario->name;
        return redirect()->route('home',['mensaje'=>$mensaje]);
    }
    
    public function crearPaciente(){
        $paciente = new Persona;
        $clientes = Persona::where('idTipoPersona',2)->get();
        return view('formularioNuevoPaciente',compact('paciente','clientes'));
    }


    protected function storePaciente(Request $request)
    {
            Persona::create([
            'nombre' => $request['name'],
            'apellido' => $request['surname'],
            'cedula' => $request['cedula'],
            'email' => $request['email'],
            'telefono' =>$request['telefono'],
            'direccion' =>$request['direccion'],
            'ciudadResi' =>$request['ciudadResi'],
            'fechaNacimiento' =>$request['fechaNacimiento'],
            'genero' =>$request['genero'],
            'estado'=> '1',
            'idTipoPersona'=>'3',
            'idPersona'=> $request['cliente']
        ]);
        return redirect()->route('home');
    }

}