<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EspecialidadesController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\ConsultaController;
use App\Http\Controllers\ExamenPDFController;
use App\Http\Controllers\RecetaController;
use App\Http\Controllers\RecetaPDFController;
use App\Http\Controllers\SolicitudExamenController;
use App\Http\Controllers\UserController;
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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth','firstLogin');
Route::get('/especialidades/borrar/{id}',[EspecialidadesController::class,'borrar'])->name('especialidades.borrar')->middleware('auth');
Route::put('/especialidades/delete/{id}',[EspecialidadesController::class,'borrarEspecialidad'])->name('especialidades.borrarEspecialidad')->middleware('auth');
Route::get('/especialidades/medicos/{id}',[EspecialidadesController::class,'obtenerMedicos'])->name('especialidades.obtenerMedicos')->middleware('auth');
Route::resource('/especialidades', EspecialidadesController::class)->middleware('role:administrador','firstLogin','auth');
Route::get('/gestionarMedicos', [PersonaController::class,'mostrarMedicos'])->name('personaMostrarMedicos')->middleware('auth','firstLogin','role:administrador');
Route::get('editarMedico/{id}',[PersonaController::class,'editarMedico'])->name('medico.edit')->middleware('auth');
Route::put('actualizarMedico/{request}',[PersonaController::class,'updateMedico'])->name('medico.update')->middleware('auth');
Route::get('crearMedico',[PersonaController::class,'crearMedico'])->name('medico.create')->middleware('role:administrador','auth','firstLogin');
Route::post('registrarMedico/',[PersonaController::class,'guardarMedico'])->name('medico.store')->middleware('auth');
Route::get('/borrarMedico/{id}',[PersonaController::class,'borrarMedico'])->name('medico.borrar')->middleware('role:administrador','auth');
Route::put('deleteMedico/{id}',[PersonaController::class,'deleteMedico'])->name('medico.delete')->middleware('auth');
Route::post('/registrarCliente',[PersonaController::class,'storeCliente'])->name('cliente.store')->middleware('auth');
Route::get('/crearCliente',[PersonaController::class,'crearCliente'])->name('cliente.create')->middleware('role:administrador','auth','firstLogin');
Route::post('/registrarPaciente',[PersonaController::class,'storePaciente'])->name('paciente.store')->middleware('auth');
Route::get('/crearPaciente',[PersonaController::class,'crearPaciente'])->name('paciente.create')->middleware('role:administrador','auth','firstLogin');
Route::get('/cliente/crearPaciente/{id}',[PersonaController::class,'crearPacienteCliente'])->name('pacienteCliente.create')->middleware('role:cliente','auth','firstLogin');
Route::get('/Cita/borrar/{id}',[CitaController::class,'borrar'])->name('cita.borrar')->middleware('auth');
Route::post('/Cita/cancelar',[CitaController::class,'borrarCita'])->name('cita.delete')->middleware('auth');
Route::get('/Cita/obtener',[CitaController::class,'obtenerCitas'])->name('cita.get')->middleware('auth');
Route::get('/Cita/reporteEspecialidad',[CitaController::class,'reporte'])->name('cita.reporte')->middleware('role:administrador','auth','firstLogin');
Route::post('/Cita/agendar', [CitaController::class,'agendarCita'])->name('cita.agendar')->middleware('auth');
Route::post('/Cita/modificar', [CitaController::class,'modificarCita'])->name('cita.modificar')->middleware('auth');
Route::post('/Consulta/guardar',[ConsultaController::class, 'guardar'])->name('consulta.guardar')->middleware('auth');
Route::get('/RecetaPDF/{id}',[RecetaPDFController::class,'obtenerReceta'])->name('receta.pdf')->middleware('auth');
Route::get('/RecetaPDF/download/{id}',[RecetaPDFController::class,'downloadPDF'])->name('recetaPDF.descargar')->middleware('auth');
Route::get('/ExamenesPDF/{id}',[ExamenPDFController::class,'obtenerExamenes'])->name('examenes.pdf')->middleware('auth');
Route::get('/ExamenesPDF/download/{id}',[ExamenPDFController::class,'downloadPDF'])->name('examenesPDF.descargar')->middleware('auth');
Route::get('/asignarContraseña',[UserController::class,'mostrarAsignar'])->name('contraseña.asignar.mostrar');
Route::post('/asignaContraseña',[UserController::class,'asignarContrasena'])->name('contraseña.asignar.actualizar');
Route::resource('/HistorialMedico',ConsultaController::class)->middleware('role:cliente,medico','auth','firstLogin');
Route::resource('/cita',CitaController::class)->middleware('firstLogin','auth');

