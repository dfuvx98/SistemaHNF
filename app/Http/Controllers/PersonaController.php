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
        if($medico->estado!=false){
        $especialidades = Especialidades::where('estado',True)->get();
        $especialidadesMedicos = Persona_Especialidad::where('idPersona',$medico->id)->get();
        return view ('formularioEditarMedico',compact('medico','especialidades','especialidadesMedicos'));
        }
        else return back();
    }


    public function crearMedico(){
        $medico = new Persona;
        $especialidades = Especialidades::where('estado',True)->get();
        return view('formularioNuevoMedico',compact('medico','especialidades'));
    }


    public function guardarMedico(Request $request){

        $request->validate([
            'nombre' => 'required|max:40|',
            'apellido' => 'required|max:40|',
            'cedula' => 'required|digits:10|numeric',
            'email' => 'required|unique:users',
            'telefono' => 'required|between:9,15|',
            'direccion' => 'required',
            'ciudadResi' => 'required',
            'fechaNacimiento' => 'required',
            'genero' => 'required',
        ],
        [


            'nombre.max' =>"El nombre de la persona no puede ser mayor a 40 caracteres",
            'apellido.max' =>"El apellido de la persona no puede ser mayor a 40 caracteres",
            'cedula.digits' =>"La cédula tiene que tener 10 caracteres",
            'cedula.numeric' =>"La cédula tiene que ser numérica",
            'telefono.between' =>"El número de teléfono tiene que tener entre 9 y 15 caracteres",
            'email.unique' =>"Ya existe un usuario con ese correo electrónico"
        ]);



        $especialidades = $request->especialidad;
        $nombreUsuario= 'D'.$request['cedula'];
        if(User::where('name',$nombreUsuario)->first()){
            return redirect()->back()->withErrors(['Un usuario con ese nombre ya existe, revise la cédula y el rol']);
         }

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
            'idPersona'=> $medico->id,
            'estado' => 2
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
        
        $request->validate([
            'nombre' => 'required|max:40|',
            'apellido' => 'required|max:40|',
            'cedula' => 'required|digits:10|numeric',
            'email' => 'required|unique:users,email,'.$medico->Users->id,
            'telefono' => 'required|between:9,15|',
            'direccion' => 'required',
            'ciudadResi' => 'required',
            'fechaNacimiento' => 'required',
            'genero' => 'required',
        ],
        [


            'nombre.max' =>"El nombre de la persona no puede ser mayor a 40 caracteres",
            'apellido.max' =>"El apellido de la persona no puede ser mayor a 40 caracteres",
            'cedula.digits' =>"La cédula tiene que tener 10 caracteres",
            'cedula.numeric' =>"La cédula tiene que ser numérica",
            'telefono.between' =>"El número de teléfono tiene que tener entre 9 y 15 caracteres",
            'email.unique' => "Ya hay un usuario que utiliza ese correo, utilice otro correo"

        ]);

        
        $especialidades = $request->especialidad;
        $medico->fill($request->all());
        $usuario = User::where('idPersona',$medico->id)->first();
        $usuarioCorreo = $medico->email; 
        $usuario->email = $usuarioCorreo;
        
        if($medico ->save() && $usuario->save()){
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
        $user->estado =0;
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

        $request->validate([
            'name' => 'required|max:40|',
            'surname' => 'required|max:40|',
            'cedula' => 'required|digits:10|numeric',
            'email' => 'required|unique:users',
            'telefono' => 'required|between:9,15',
            'direccion' => 'required',
            'ciudadResi' => 'required',
            'fechaNacimiento' => 'required',
            'genero' => 'required',
        ],
        [
            'name.max' =>"El nombre de la especialidad no puede ser mayor a 40 caracteres",
            'surname.max' =>"El apellido de la especialidad no puede ser mayor a 40 caracteres",
            'cedula.digits' =>"La cédula tiene que tener 10 caracteres",
            'cedula.numeric' =>"La cédula tiene que ser numérica",
            'telefono.between' =>"El número de teléfono tiene que tener entre 9 y 15 caracteres",
            'email.unique' =>"Ya existe un usuario con ese correo electrónico"
        ]);

        $nombreUsuario= 'C'.$request['cedula'];

        if(User::where('name',$nombreUsuario)->first()){
            return redirect()->back()->withErrors(['Un usuario con ese nombre ya existe, revise la cédula y el rol']);
         }

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
            'idPersona'=> $cliente->id,
            'estado' => 2
        ]);
        $mensaje = 'Se creó el cliente '.$cliente->nombre.' '.$cliente->apellido.' con usuario '. $usuario->name;
        return redirect()->route('home',['mensaje'=>$mensaje]);
    }

    public function crearPaciente(){
        $paciente = new Persona;
        $clientes = Persona::where('idTipoPersona',2)->get();
        return view('formularioNuevoPaciente',compact('paciente','clientes'));
    }

    public function crearPacienteCliente($id){
        $paciente = new Persona;
        $clientes = Persona::where('id', $id)->where('idTipoPersona',2)->get();
        return view('formularioNuevoPaciente',compact('paciente','clientes'));
    }

    protected function storePaciente(Request $request)
    {

        $request->validate([
            'name' => 'required|max:40|',
            'surname' => 'required|max:40|',
            'cedula' => 'required|digits:10|numeric',
            'direccion' => 'required',
            'ciudadResi' => 'required',
            'fechaNacimiento' => 'required',
            'genero' => 'required',
        ],
        [
            'name.max' =>"El nombre de la especialidad no puede ser mayor a 40 caracteres",
            'surname.max' =>"El apellido de la especialidad no puede ser mayor a 40 caracteres",
            'cedula.digits' =>"La cédula tiene que tener 10 caracteres",
            'cedula.numeric' =>"La cédula tiene que ser numérica",

        ]);
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
