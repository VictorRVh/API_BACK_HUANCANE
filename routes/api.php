<?php

use App\Http\Controllers\AsistenciaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\EspecialidadController;
use App\Http\Controllers\ExperienciaFormativaController;
use App\Http\Controllers\GrupoController;
use App\Http\Controllers\IndicadorLogroController;
use App\Http\Controllers\MatriculaController;
use App\Http\Controllers\NotaExperienciaFormativaController;
use App\Http\Controllers\NotaUnidadDidacticaController;
use App\Http\Controllers\PermisoController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\ProgramaController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\RolPermisoController;
use App\Http\Controllers\SedeController;
use App\Http\Controllers\TurnoController;
use App\Http\Controllers\UnidadDidacticaController;
use App\Http\Controllers\UsuarioController;
use App\Models\NotaUnidadDidactica;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//RUTAS PARA ROLES
Route::get('/rol',[RolController::class,'index']);
Route::post('/rol',[RolController::class,'store']);
Route::get('/rol/{id}',[RolController::class, 'show']);
Route::put('/rol/{id}',[RolController::class, 'update']);
Route::delete('/rol/{id}',[RolController::class, 'destroy']);

//RUTAS PARA PERMISOS
Route::get('/permisos',[PermisoController::class,'index']);
Route::post('/permisos',[PermisoController::class,'store']);
Route::get('/permisos/{id}',[PermisoController::class, 'show']);
Route::put('/permisos/{id}',[PermisoController::class, 'update']);
Route::delete('/permisos/{id}',[PermisoController::class, 'destroy']);

//RUTAS ROL_PERMISO
Route::get('/rol_permisos',[RolPermisoController::class,'index']);
Route::post('/rol_permisos',[RolPermisoController::class,'store']);
Route::get('/rol_permisos/{id}',[RolPermisoController::class, 'show']);
Route::put('/rol_permisos/{id}',[RolPermisoController::class, 'update']);
Route::delete('/rol_permisos/{id}',[RolPermisoController::class, 'destroy']);

//RUTAS PARA USUARIO
Route::get('/usuario',[UsuarioController::class,'index']);
Route::post('/usuario',[UsuarioController::class,'store']);
Route::get('/usuario/{id}',[UsuarioController::class, 'show']);
Route::put('/usuario/{id}',[UsuarioController::class, 'update']);
Route::delete('/usuario/{id}',[UsuarioController::class, 'destroy']);

//RUTAS PARA SEDES
Route::get('/sedes',[SedeController::class,'index']);
Route::post('/sedes',[SedeController::class,'store']);
Route::get('/sedes/{id}',[SedeController::class, 'show']);
Route::put('/sedes/{id}',[SedeController::class, 'update']);
Route::delete('/sedes/{id}',[SedeController::class, 'destroy']);

//RUTAS PARA TURNOS
Route::get('turnos', [TurnoController::class, 'index']);
Route::post('turnos', [TurnoController::class, 'store']);
Route::get('turnos/{id}', [TurnoController::class, 'show']);
Route::put('turnos/{id}', [TurnoController::class, 'update']);
Route::delete('turnos/{id}', [TurnoController::class, 'destroy']);

// RUTAS PARA ESPECIALIDADES
Route::get('/especialidad',[EspecialidadController::class,'index']);
Route::post('/especialidad',[EspecialidadController::class,'store']);
Route::get('/especialidad/{id}',[EspecialidadController::class, 'show']);
Route::put('/especialidad/{id}',[EspecialidadController::class, 'update']);
Route::delete('/especialidad/{id}',[EspecialidadController::class, 'destroy']);

// RUTAS PARA PLANES (CICLO FORMATIVO)
Route::get('planes', [PlanController::class, 'index']);
Route::post('planes', [PlanController::class, 'store']);
Route::get('planes/{id}', [PlanController::class, 'show']);
Route::put('planes/{id}', [PlanController::class, 'update']);
Route::delete('planes/{id}', [PlanController::class, 'destroy']);

//RUTAS PARA PROGRAMAS (MODULO FORMATIVO)
Route::get('programas', [ProgramaController::class, 'index']);
Route::post('programas', [ProgramaController::class, 'store']);
Route::get('programas/{id}', [ProgramaController::class, 'show']);
Route::put('programas/{id}', [ProgramaController::class, 'update']);
Route::delete('programas/{id}', [ProgramaController::class, 'destroy']);

// RUTAS PARA UNIDAD DIDACTICA
Route::get('/unidad_didactica',[UnidadDidacticaController::class,'index']);
Route::get('/unidad_didactica/{id}',[UnidadDidacticaController::class, 'show']);
Route::post('/unidad_didactica',[UnidadDidacticaController::class,'store']);
Route::put('/unidad_didactica/{id}',[UnidadDidacticaController::class, 'update']);
Route::delete('/unidad_didactica/{id}',[UnidadDidacticaController::class, 'destroy']);

// RUTA DE EXPERIENCIAS FORMATIVAS
Route::get('/experiencias_formativas',[ExperienciaFormativaController::class,'index']);
Route::get('/experiencias_formativas/{id}',[ExperienciaFormativaController::class, 'show']);
Route::post('/experiencias_formativas',[ExperienciaFormativaController::class,'store']);
Route::put('/experiencias_formativas/{id}',[ExperienciaFormativaController::class, 'update']);
Route::delete('/experiencias_formativas/{id}',[ExperienciaFormativaController::class, 'destroy']);

// RUTAS PARA GRUPOS
Route::get('/grupos',[GrupoController::class,'index']);
Route::get('/grupos/{id}',[GrupoController::class, 'show']);
Route::post('/grupos',[GrupoController::class,'store']);
Route::put('/grupos/{id}',[GrupoController::class, 'update']);
Route::delete('/grupos/{id}',[GrupoController::class, 'destroy']);

// RUTA PARA INDICADOR DE LOGRO
Route::get('/indicador_logro',[IndicadorLogroController::class,'index']);
Route::get('/indicador_logro/{id}',[IndicadorLogroController::class, 'show']);
Route::post('/indicador_logro',[IndicadorLogroController::class,'store']);
Route::put('/indicador_logro/{id}',[IndicadorLogroController::class, 'update']);
Route::delete('/indicador_logro/{id}',[IndicadorLogroController::class, 'destroy']);

// RUTA PARA MATRICULA
Route::get('/matriculas', [MatriculaController::class, 'index']);
Route::get('/matriculas/{id}', [MatriculaController::class, 'show']);
Route::post('/matriculas', [MatriculaController::class, 'store']);
Route::put('/matriculas/{id}', [MatriculaController::class, 'update']);
Route::delete('/matriculas/{id}', [MatriculaController::class, 'destroy']);

// RUTAS PARA NOTA DE UNIDAD DIDACTICA
Route::get('/nota_unidad_didactica',[NotaUnidadDidacticaController::class,'index']);
Route::get('/nota_unidad_didactica/{id}',[NotaUnidadDidacticaController::class, 'show']);
Route::post('/nota_unidad_didactica',[NotaUnidadDidacticaController::class,'store']);
Route::put('/nota_unidad_didactica/{id}',[NotaUnidadDidacticaController::class, 'update']);
Route::delete('/nota_unidad_didactica/{id}',[NotaUnidadDidacticaController::class, 'destroy']);

// RUTA PARA NOTA DE EXPERIENCIA FORMATIVA
Route::get('/nota_experiencia_formativa', [NotaExperienciaFormativaController::class, 'index']);
Route::post('/nota_experiencia_formativa', [NotaExperienciaFormativaController::class, 'store']);
Route::get('/nota_experiencia_formativa/{id}', [NotaExperienciaFormativaController::class, 'show']);
Route::put('/nota_experiencia_formativa/{id}', [NotaExperienciaFormativaController::class, 'update']);
Route::delete('/nota_experiencia_formativa/{id}', [NotaExperienciaFormativaController::class, 'destroy']);

// RUTA PARA ASISTENCIAS
Route::get('/asistencias', [AsistenciaController::class, 'index']);
Route::post('/asistencias', [AsistenciaController::class, 'store']);
Route::get('/asistencias/{id}', [AsistenciaController::class, 'show']);
Route::put('/asistencias/{id}', [AsistenciaController::class, 'update']);
Route::delete('/asistencias/{id}', [AsistenciaController::class, 'destroy']);