<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AsistenciaController;
use App\Http\Controllers\EspecialidadController;
use App\Http\Controllers\ExperienciaFormativaController;
use App\Http\Controllers\GrupoController;
use App\Http\Controllers\MatriculaController;
use App\Http\Controllers\UnidadDidacticaController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



// RUTAS PARA USER
Route::get('/asistencias',[AsistenciaController::class,'index']);
Route::post('/asistencias',[AsistenciaController::class,'store']);
Route::put('/asistencias/{id}',[AsistenciaController::class, 'update']);
Route::delete('/asistencias/{id}',[AsistenciaController::class, 'destroy']);


// Router student
Route::get('/especialidad',[EspecialidadController::class,'index']);
Route::get('/especialidad/{id}',[EspecialidadController::class, 'findOneEstudent']);
Route::post('/especialidad',[EspecialidadController::class,'store']);
Route::put('/especialidad/{id}',[EspecialidadController::class, 'update']);
Route::patch('/especialidad/{id}',[EspecialidadController::class, 'updateParcial']);
Route::delete('/especialidad/{id}',[EspecialidadController::class, 'destroy']);


Route::get('/experiencias_formativas',[ExperienciaFormativaController::class,'index']);
Route::get('/teacexperiencias_formativas',[ExperienciaFormativaController::class,'indexName']);
Route::get('/experiencias_formativas/{id}',[ExperienciaFormativaController::class, 'findOneDocente']);
Route::post('/experiencias_formativas',[ExperienciaFormativaController::class,'store']);
Route::put('/experiencias_formativas/{id}',[ExperienciaFormativaController::class, 'update']);
Route::patch('/experiencias_formativas/{id}',[ExperienciaFormativaController::class, 'updateParcial']);
Route::delete('/experiencias_formativas/{id}',[ExperienciaFormativaController::class, 'destroy']);


Route::get('/grupos',[GrupoController::class,'index']);
Route::get('/grupos/{id}',[GrupoController::class, 'findOneEstudent']);
Route::post('/grupos',[GrupoController::class,'store']);
Route::put('/grupos/{id}',[GrupoController::class, 'update']);
Route::patch('/grupos/{id}',[GrupoController::class, 'updateParcial']);
Route::delete('/grupos/{id}',[GrupoController::class, 'destroy']);


// Unidad UnidadDidactica

Route::get('/unidad_didactica',[UnidadDidacticaController::class,'index']);
Route::get('/unidad_didactica/{id}',[UnidadDidacticaController::class, 'findOne']);
Route::post('/unidad_didactica',[UnidadDidacticaController::class,'store']);
Route::put('/unidad_didactica/{id}',[UnidadDidacticaController::class, 'update']);
Route::patch('/unidad_didactica/{id}',[UnidadDidacticaController::class, 'updateParcial']);
Route::delete('/unidad_didactica/{id}',[UnidadDidacticaController::class, 'destroy']);


// Indicardor Logro

// Route::get('/indicador_logro',[IndicadorLogroController::class,'index']);
// Route::get('/indicador_logro/{id}',[IndicadorLogroController::class, 'findOne']);
// Route::post('/indicador_logro',[IndicadorLogroController::class,'store']);
// Route::put('/indicador_logro/{id}',[IndicadorLogroController::class, 'update']);
// Route::patch('/indicador_logro/{id}',[IndicadorLogroController::class, 'updateParcial']);
// Route::delete('/indicador_logro/{id}',[IndicadorLogroController::class, 'destroy']);

// MAtriculaindicador_logro

Route::get('/matricula',[MatriculaController::class,'index']);
Route::get('/matricula/{id}',[MatriculaController::class, 'findOne']);
Route::post('/matricula',[MatriculaController::class,'store']);
Route::put('/matricula/{id}',[MatriculaController::class, 'update']);
Route::patch('/matricula/{id}',[MatriculaController::class, 'updateParcial']);
Route::delete('/matricula/{id}',[MatriculaController::class, 'destroy']);
