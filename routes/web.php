<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EspecialidadesController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\TestController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/especialidad',[EspecialidadesController::class,'borrarEspecialidad'])->name('borrarEspecialidad');
Route::get('/especialidad',[EspecialidadesController::class,'restaurarEspecialidad'])->name('restaurarEspecialidad');
Route::resource('/especialidades', EspecialidadesController::class);
Route::get('/gestionarMedicos', [PersonaController::class,'mostrarMedicos'])->name('personaMostrarMedicos');


