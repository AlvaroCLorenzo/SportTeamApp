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
Route::get('/login',[LoginController::class,'prueba']);

//validacion login
Route::post('/validacion-login');

//registro
Route::get('/registro');

//cambio de contraseña
Route::get('/cambio-contra');

//hub de secciones
Route::get('/hub');

//perfil
Route::get('/mi-club');

//vista partidos
Route::get('/partidos');

//vista partidos seccion info
Route::get('/info-partido');

//vista entrenamientos
Route::get('/entrenamientos');

//vista entrenamientos seccion info
Route::get('/info-entrenamiento');

//vista jugadores
Route::get('/jugadores');

//vista jugadroes seccion info
Route::get('/info-jugador');
