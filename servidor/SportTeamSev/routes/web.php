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
    return view('unlogin/index');
});

//login

Route::get('/insercion',[LoginController::class,'insercion']);

Route::get('/login', function () {
    return view('unlogin/login');
});



//validacion login
Route::post('/validacion-login',function () {
    return view('validacion-login');
});

//registro
Route::get('/registro', function () {
    return view('unlogin/registro');
});

//cambio de contraseña
Route::get('/cambio-contra', function () {
    return view('login/cambio-contra');
});

//hub de secciones
Route::get('/hub', function () {
    return view('login/hub');
});

//perfil
Route::get('/mi-club', function () {
    return view('login/mi-club');
});

//vista partidos
Route::get('/partidos', function () {
    return view('login/secciones/partidos');
});

//vista partidos seccion info
Route::get('/info-partido', function () {
    return view('login/info/info-partido');
});

//vista entrenamientos
Route::get('/entrenamientos', function () {
    return view('login/secciones/entrenamientos');
});

//vista entrenamientos seccion info
Route::get('/info-entrenamiento', function () {
    return view('login/info/info-entrenamientos');
});

//vista jugadores
Route::get('/jugadores', function () {
    return view('login/secciones/jugadores');
});

//vista jugadroes seccion info
Route::get('/info-jugador', function () {
    return view('login/info/info-jugador');
});

//vista jugadroes seccion info
Route::get('/cerrar-sesion', function () {
    return view('cerrar-sesion');
});
