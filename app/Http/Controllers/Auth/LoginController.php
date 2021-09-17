<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
    return 'name';
    }

        /**
     * Intento de login personalizado que
     * permite loggearse solo si el usuario tiene el estado 1
     * de activado o 2 de que se va a loggear por primera vez y tiene la 
     * contraseña por defecto.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function credentials(Request $request)
{
    $username = $this->username();

    return [
        $username => $request->get($username),
        'password' => $request->get('password'),
        'estado' => [ 1, 2 ], // OR condition
    ];
}
}
