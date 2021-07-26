<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EspecialidadesController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\ConsultaController;
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
Route::get('/especialidades/borrar/{id}',[EspecialidadesController::class,'borrar'])->name('especialidades.borrar');
Route::put('/especialidades/delete/{id}',[EspecialidadesController::class,'borrarEspecialidad'])->name('especialidades.borrarEspecialidad');
Route::get('/especialidades/medicos/{id}',[EspecialidadesController::class,'obtenerMedicos'])->name('especialidades.obtenerMedicos');
Route::resource('/especialidades', EspecialidadesController::class);
Route::get('/gestionarMedicos', [PersonaController::class,'mostrarMedicos'])->name('personaMostrarMedicos');
Route::get('editarMedico/{id}',[PersonaController::class,'editarMedico'])->name('medico.edit');
Route::put('actualizarMedico/{request}',[PersonaController::class,'updateMedico'])->name('medico.update');
Route::get('crearMedico',[PersonaController::class,'crearMedico'])->name('medico.create');
Route::post('registrarMedico/',[PersonaController::class,'guardarMedico'])->name('medico.store');
Route::get('/borrarMedico/{nombre}',[PersonaController::class,'borrarMedico'])->name('medico.borrar');
Route::put('deleteMedico/{id}',[PersonaController::class,'deleteMedico'])->name('medico.delete');
Route::post('/registrarCliente',[PersonaController::class,'storeCliente'])->name('cliente.store');
Route::get('/crearCliente',[PersonaController::class,'crearCliente'])->name('cliente.create');
Route::post('/registrarPaciente',[PersonaController::class,'storePaciente'])->name('paciente.store');
Route::get('/crearPaciente',[PersonaController::class,'crearPaciente'])->name('paciente.create');
Route::get('/cliente/crearPaciente/{id}',[PersonaController::class,'crearPacienteCliente'])->name('pacienteCliente.create');
Route::get('/Cita/borrar/{id}',[CitaController::class,'borrar'])->name('cita.borrar');
Route::post('/Cita/cancelar',[CitaController::class,'borrarCita'])->name('cita.delete');
Route::get('/Cita/obtener',[CitaController::class,'obtenerCitas'])->name('cita.get');
Route::post('/Cita/agendar', [CitaController::class,'agendarCita'])->name('cita.agendar');
Route::post('/Cita/modificar', [CitaController::class,'modificarCita'])->name('cita.modificar');
Route::post('/Consulta/guardar',[ConsultaController::class, 'guardar'])->name('consulta.guardar');
//Route::post('/Cita/dropUpdate', [CitaController::class, 'dropUpdateCitas'])->name('cita.dropUpdate');
Route::resource('/cita',CitaController::class);

