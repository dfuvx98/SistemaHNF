<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
class UserController extends Controller
{
    //

    public function mostrarAsignar(){
        return view('auth/passwords/resetPasswordFirst');
    }

    public function asignarContrasena(Request $request){

        $request->validate([
            'password' => 'confirmed|min:8',
            
        ],
        [

            'password.confirmed' =>"Las contraseñas no coinciden",
            'password.min' =>"Las contraseña debe tener como mínimo 8 caracteres",
        ]);

        $usuario = Auth::user();
        $contraseña = $request['password'];
        $usuario->password = Hash::make($contraseña);
        $usuario->estado=1;
        if($usuario->save()){
            return redirect()->route('home');
        }
        return redirect()->back()->withErrors(['No se pudo asignar contraseña intente de nuevo']);;



    }

}
