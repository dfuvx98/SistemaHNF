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
            'name' => ['required', 'string', 'max:40'],
            'surname' => ['required', 'string', 'max:40'],
            'cedula' => ['required', 'numeric', 'digits:10'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'telefono' => ['required', 'string', 'between:9,15'],
            'direccion' => ['required', 'string', 'max:255'],
            'ciudadResi' => ['required', 'string', 'max:255'],
            'genero' => ['required', 'string', 'max:255'],
        ],
        [

            'name.max' =>"El nombre de la persona no puede ser mayor a 40 caracteres",
            'surname.max' =>"El apellido de la persona no puede ser mayor a 40 caracteres",
            'cedula.digits' =>"La cédula tiene que tener 10 caracteres",
            'cedula.numeric' =>"La cédula tiene que ser numérica",
            'telefono.between' =>"El número de teléfono tiene que tener entre 9 y 15 caracteres",
            'email.unique' =>"Ya existe un usuario con ese correo electrónico"
            ]

        );
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
        'telefono' =>$data['telefono'],'direccion' =>$data['direccion'],'ciudadResi' =>$data['ciudadResi'],'fechaNacimiento' =>$data['fechaNacimiento'],
        'genero' =>$data['genero'],];
        
  
        
        $persona= Persona::create([
            'nombre' => $datos['nombre'],
            'apellido' => $datos['apellido'],
            'cedula' => $datos['cedula'],
            'email' => $datos['email'],
            'telefono' =>$datos['telefono'],
            'direccion' =>$datos['direccion'],
            'ciudadResi' =>$datos['ciudadResi'],
            'fechaNacimiento' =>$datos['fechaNacimiento'],
            'genero' =>$datos['genero'],
            'estado'=> '1',
            'idTipoPersona'=>'2'
        ]);



        return User::create([
            'name' => 'C'.$data['cedula'],
            'email' => $data['email'],
            'password' => Hash::make('C'.$data['cedula']),
            'role' => 'cliente',
            'idPersona'=> $persona->id,
            'estado'=> 2
        ]);

    }
}
