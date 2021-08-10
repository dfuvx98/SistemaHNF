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
Route::get('/especialidades/borrar/{id}',[EspecialidadesController::class,'borrar'])->name('especialidades.borrar')->middleware('auth');
Route::put('/especialidades/delete/{id}',[EspecialidadesController::class,'borrarEspecialidad'])->name('especialidades.borrarEspecialidad')->middleware('auth');
Route::get('/especialidades/medicos/{id}',[EspecialidadesController::class,'obtenerMedicos'])->name('especialidades.obtenerMedicos')->middleware('auth');
Route::resource('/especialidades', EspecialidadesController::class);
Route::get('/gestionarMedicos', [PersonaController::class,'mostrarMedicos'])->name('personaMostrarMedicos')->middleware('auth');
Route::get('editarMedico/{id}',[PersonaController::class,'editarMedico'])->name('medico.edit')->middleware('auth');
Route::put('actualizarMedico/{request}',[PersonaController::class,'updateMedico'])->name('medico.update')->middleware('auth');
Route::get('crearMedico',[PersonaController::class,'crearMedico'])->name('medico.create')->middleware('auth');
Route::post('registrarMedico/',[PersonaController::class,'guardarMedico'])->name('medico.store')->middleware('auth');
Route::get('/borrarMedico/{nombre}',[PersonaController::class,'borrarMedico'])->name('medico.borrar')->middleware('auth');
Route::put('deleteMedico/{id}',[PersonaController::class,'deleteMedico'])->name('medico.delete')->middleware('auth');
Route::post('/registrarCliente',[PersonaController::class,'storeCliente'])->name('cliente.store')->middleware('auth');
Route::get('/crearCliente',[PersonaController::class,'crearCliente'])->name('cliente.create')->middleware('auth');
Route::post('/registrarPaciente',[PersonaController::class,'storePaciente'])->name('paciente.store')->middleware('auth');
Route::get('/crearPaciente',[PersonaController::class,'crearPaciente'])->name('paciente.create')->middleware('auth');
Route::get('/cliente/crearPaciente/{id}',[PersonaController::class,'crearPacienteCliente'])->name('pacienteCliente.create');
Route::get('/Cita/borrar/{id}',[CitaController::class,'borrar'])->name('cita.borrar')->middleware('auth');
Route::post('/Cita/cancelar',[CitaController::class,'borrarCita'])->name('cita.delete')->middleware('auth');
Route::get('/Cita/obtener',[CitaController::class,'obtenerCitas'])->name('cita.get')->middleware('auth');
Route::post('/Cita/agendar', [CitaController::class,'agendarCita'])->name('cita.agendar')->middleware('auth');
Route::post('/Cita/modificar', [CitaController::class,'modificarCita'])->name('cita.modificar')->middleware('auth');
Route::post('/Consulta/guardar',[ConsultaController::class, 'guardar'])->name('consulta.guardar')->middleware('auth');
Route::get('/RecetaPDF/{id}',[RecetaPDFController::class,'obtenerReceta'])->name('receta.pdf')->middleware('auth');
Route::get('/RecetaPDF/download/{id}',[RecetaPDFController::class,'downloadPDF'])->name('recetaPDF.descargar')->middleware('auth');
Route::get('/ExamenesPDF/{id}',[ExamenPDFController::class,'obtenerExamenes'])->name('examenes.pdf')->middleware('auth');
Route::get('/ExamenesPDF/download/{id}',[ExamenPDFController::class,'downloadPDF'])->name('examenesPDF.descargar')->middleware('auth');
Route::resource('/SolicitudesExamenes',SolicitudExamenController::class);
Route::resource('/HistorialMedico',ConsultaController::class);
Route::resource('/Recetas',RecetaController::class);
//Route::post('/Cita/dropUpdate', [CitaController::class, 'dropUpdateCitas'])->name('cita.dropUpdate');
Route::resource('/cita',CitaController::class);

