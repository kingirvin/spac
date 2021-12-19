<?php

use Illuminate\Support\Facades\Route;

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
    return view('auth.login');
});

Auth::routes();

Route::get('/miPerfil', 'HomeController@index')->name('miPerfil');
Route::post('/registrar','Auth\RegisterUserController@create')->name('registrar');

Route::get('/nuevoUsuario', 'HomeController@nuevoUsuario')->name('nuevoUsuario');
Route::post('/registrarUsuario','HomeController@registroUsuario')->name('registrarUsuario');

Route::get('/editarPerfil','HomeController@editarPerfil');
Route::post('/editarPerfil','HomeController@guardarPerfil')->name('editarPerfil');
Route::get('/programacionAnual','HomeController@planAnual');
//Route::post('/programacionAnual','HomeController@planAnual')->name('datosPlanAnual');
Route::get('/listarUsuario', 'HomeController@listarUsuario')->name('listarUsuario');
Route::post('listarUsuario', 'HomeController@activarPlan')->name('listarUsuario');

//=================================================================================crea un plan anual en cero
Route::post('/creaPlanAnual','HomeController@creaPlanAnual'); 
Route::post('/agragarUnidadCompetencia','HomeController@agragarUnidadCompetencia'); 
Route::post('/agragarUnidadEnfoque','HomeController@agragarUnidadEnfoque'); 
Route::post('/actualizarUnidadEnfoque','HomeController@actualizarUnidadEnfoque'); 
Route::post('/ActualizarUnidades','HomeController@ActualizarUnidades'); 
Route::post('/actualizarEstadoUnidad','HomeController@actualizarEstadoUnidad'); 
Route::get('/acutalizarPlanAnual{id}', 'HomeController@acutalizarPlanAnual');

//================================================================================== metodos de nueva competencia
Route::get('/nuevaCompetencia', 'HomeController@nuevaCompetencia');
Route::post('nuevaCompetencia', 'HomeController@agregarCompetencia');

Route::post('listaDesempeno', 'HomeController@listaDesempeno');
Route::post('nuevoDesempeno', 'HomeController@nuevoDesempeno');
Route::post('eliminarDesempeno', 'HomeController@eliminarDesempeno');
Route::post('actualizarDesempeno', 'HomeController@actualizarDesempeno');
Route::post('buscarDesempeno', 'HomeController@buscarDesempeno');

Route::post('listaCapacidad', 'HomeController@listaCapacidad');
Route::post('nuevaCapacidad', 'HomeController@nuevaCapacidad');
Route::post('buscarCapacidad', 'HomeController@buscarCapacidad');
Route::post('actualizarCapacidad', 'HomeController@actualizarCapacidad');
Route::post('eliminarCapacidad', 'HomeController@eliminarCapacidad');
//================================================================================== metodos de nuevo Enfoque
Route::get('/nuevoEnfoque', 'HomeController@nuevEnfoque');
Route::post('nuevoEnfoque', 'HomeController@agregarEnfoque');

Route::post('listaActitud', 'HomeController@listaActitud');
Route::post('nuevoActitud', 'HomeController@nuevoActitud');
Route::post('eliminarActitud', 'HomeController@eliminarActitud');
Route::post('actualizarActitud', 'HomeController@actualizarActitud');
Route::post('buscarActitud', 'HomeController@buscarActitud');
//================================================================================== metodos de nuevo Momento
Route::get('/nuevoMomento', 'HomeController@nuevoMomento');
Route::post('buscarCompetenciaCurso', 'HomeController@buscarCompetenciaCurso');
Route::post('nuevoMomento', 'HomeController@nuevoMomentoDatos');






//================================================================================== programación de unidades
Route::get('/programacionUnidad', 'HomeController@programacionUnidad');
Route::post('buscarUnidadesPlan', 'HomeController@buscarUnidadesPlan');
Route::post('buscarCompetenciasnidadesPlan', 'HomeController@buscarCompetenciasnidadesPlan');
// metodos de criterios de aprendizaje
Route::post('nuevoDesempenoPlan', 'HomeController@nuevoDesempenoPlan');
Route::post('buscarCriterioPlan', 'HomeController@buscarCriterioPlan');
Route::post('actualizaCriterioPlan', 'HomeController@actualizaCriterioPlan');
Route::post('eliminarCriterioPlan', 'HomeController@eliminarCriterioPlan');
// metodos de evidencias de aprendizaje
Route::post('nuevaEvidencia', 'HomeController@nuevaEvidencia');
Route::post('eliminarEvidencia', 'HomeController@eliminarEvidencia');
Route::post('buscarEvidencia', 'HomeController@buscarEvidencia');
Route::post('actualizaEvidencia', 'HomeController@actualizaEvidencia');
// metodos de instrumentos de aprendizaje
Route::post('buscarInstrumento', 'HomeController@buscarInstrumento');
Route::post('eliminarInstrumento', 'HomeController@eliminarInstrumento');
Route::post('nuevaInstrumento', 'HomeController@nuevaInstrumento');
Route::post('actualizaInstrumento', 'HomeController@actualizaInstrumento');
Route::post('listaInstrumento', 'HomeController@listaInstrumento');
// metodos de Acciones o Actitudes de lso Enfoques
Route::post('nuevoActitudPlan', 'HomeController@nuevoActitudPlan');
Route::post('buscarActitudPlan', 'HomeController@buscarActitudPlan');
Route::post('actualizaActitudPlan', 'HomeController@actualizaActitudPlan');
Route::post('eliminarActitudPlan', 'HomeController@eliminarActitudPlan');
// metodos de situacion
Route::post('nuevaSituacion', 'HomeController@nuevaSituacion');
Route::post('actualizarSituacion', 'HomeController@nuevaSituacion');
// metodos de sesiones de aprendizaje
Route::post('nuevaSesionAprendizaje', 'HomeController@nuevaSesionAprendizaje');
Route::post('listarSesionesUnidad', 'HomeController@listarSesionesUnidad');
Route::post('buscarCurso', 'HomeController@buscarCurso');
Route::post('listarCriteriosCurso', 'HomeController@listarCriteriosCurso');
Route::post('buscarCriterio', 'HomeController@buscarCriterio');
Route::post('actualizarSesion', 'HomeController@actualizarSesion');
Route::post('actualizarNombreSesion', 'HomeController@actualizarNombreSesion');
Route::post('agregarMaterial', 'HomeController@agregarMaterial');
//agrega material para usar en la unidad
Route::post('listarMaterialUnidad', 'HomeController@listarMaterialUnidad');
Route::post('eliminarMaterial', 'HomeController@eliminarMaterial');


//======================================================================================Programacion de sesiones===============================================
Route::get('/programacionSesion', 'HomeController@nuevaSesion');
Route::post('/buscarsesionesPlan', 'HomeController@buscarsesionesPlan');
Route::post('/buscarsesionePlan', 'HomeController@buscarsesionePlan');
Route::post('/nuevoEnfoqueSesion', 'HomeController@nuevoEnfoqueSesion');
Route::post('/listarActitudSesion', 'HomeController@listarActitudSesion');
Route::post('/actualizarActitudEnfoqueSesion', 'HomeController@actualizarActitudEnfoqueSesion');
Route::post('/eliminarEnfoqueSesion', 'HomeController@eliminarEnfoqueSesion');
Route::post('/agregarMaterialSesion', 'HomeController@agregarMaterialSesion');
Route::post('/agregarAntesde', 'HomeController@agregarAntesde');
Route::post('/actualizarTiempoSesion', 'HomeController@actualizarTiempoSesion');
Route::post('/actualizarFechaSesion', 'HomeController@actualizarFechaSesion');
Route::post('/eliminarSesion', 'HomeController@eliminarSesion');
Route::post('/actualizarSesionMomento', 'HomeController@actualizarSesionMomento');
Route::post('/actualizarSesionProceso', 'HomeController@actualizarSesionProceso');

//Vistas para imprimir
Route::get('/vistaPreviaUnidad{id}', 'ImprimirController@vistaPreviaUnidad');
Route::get('/descargarUnidad{id}', 'ImprimirController@descargarUnidad');
//Route::get('/imprimir{id}', 'ImprimirController@imprimir');



