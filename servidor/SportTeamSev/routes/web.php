<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;

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

//vista de entrada index
Route::get('/', function () {
    return view('index');
});

//login

Route::get('/insercion',[LoginController::class,'insercion']);

Route::get('/login', function () {
    return view('login');
});



//validacion login
Route::post('/validacion-login',function () {
    return view('validacion-login');
});

//registro
Route::get('/registro', function () {
    return view('registro');
});

//cambio de contraseña
Route::get('/cambio-contra', function () {
    return view('cambio-contra');
});

//hub de secciones
Route::get('/hub', function () {
    return view('hub');
});

//perfil
Route::get('/mi-club', function () {
    return view('mi-club');
});

//vista partidos
Route::get('/partidos', function () {
    return view('partidos');
});

//vista partidos seccion info
Route::get('/info-partido', function () {
    return view('indo-partido');
});

//vista entrenamientos
Route::get('/entrenamientos', function () {
    return view('entrenamientos');
});

//vista entrenamientos seccion info
Route::get('/info-entrenamiento', function () {
    return view('info-entrenamientos');
});

//vista jugadores
Route::get('/jugadores', function () {
    return view('jugadores');
});

//vista jugadroes seccion info
Route::get('/info-jugador', function () {
    return view('info-jugador');
});

//vista jugadroes seccion info
Route::get('/cerrar-sesion', function () {
    return view('cerrar-sesion');
});
