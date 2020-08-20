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
Route::post('/registrarUsuario','HomeController@registroUsuario')->name('registrarUsuario');
Route::get('/listarUsuario', 'HomeController@listarUsuario')->name('listarUsuario');
Route::get('/nuevoUsuario', 'HomeController@nuevoUsuario')->name('nuevoUsuario');
Route::post('listarUsuario', 'HomeController@activarPlan')->name('listarUsuario');


