<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Persona;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */
    
    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'nick' => ['required', 'string', 'max:255'],
            'cedula' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'telefono' => ['required', 'string', 'max:255'],
            'direccion' => ['required', 'string', 'max:255'],
            'ciudadResi' => ['required', 'string', 'max:255'],
            'genero' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            

        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {

        $datos= ['nombre' => $data['name'],'apellido' => $data['surname'],'cedula' => $data['cedula'],'email' => $data['email'],
        'telefono' =>$data['telefono'],'direccion' =>$data['direccion'],'ciudadResi' =>$data['ciudadResi'],'genero' =>$data['genero'],]; 
        
        
        $a= Persona::create([
            'nombre' => $datos['nombre'],
            'apellido' => $datos['apellido'],
            'cedula' => $datos['cedula'],
            'email' => $datos['email'],
            'telefono' =>$datos['telefono'],
            'direccion' =>$datos['direccion'],
            'ciudadResi' =>$datos['ciudadResi'],
            'fechaNacimiento' =>'1998-03-05',
            'genero' =>$datos['genero'],
            'estado'=> '1',
            'idTipoPersona'=>'2'
        ]);
        
        
        
        return User::create([
            'name' => 'clienteUser',
            'surname' => $data['surname'],
            'email' => $data['email'],
            'nick' => $data['nick'],
            'password' => Hash::make($data['password']),
            'role' => 'cliente',
            'idPersona'=> $a->id
        ]);
        
    }
}
