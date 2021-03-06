<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\WebController;

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

Route::get('/insercion',[LoginController::class,'insercion']);

//vista de entrada index
Route::get('/',[WebController::class,'getIndex']);

//login
Route::get('/login',[WebController::class,'getLogin']);


//validacion login
Route::post('/validacion-login',[WebController::class,'logear']);

//vista jugadroes seccion info
Route::get('/cerrar-sesion',[WebController::class,'unLogear']);


//registro
Route::get('/registro', function () {
    return view('unlogin/registro');
});

//registro
Route::post('/registrarUsuario',[WebController::class, 'registrarClub']);

//cambio de contraseña
Route::post('/cambio-contra',[WebController::class,'cambiarContra']);

//cambio de contraseña
Route::post('/actualizarContra',[WebController::class,'actualizarContra']);

//hub
//validacion login
Route::get('/hub',[WebController::class,'getHub']);

//perfil del usuario
Route::get('/mi-club',[WebController::class,'getMiClub']);

//cambiar imagen
Route::post('/cambiar-imagen',[WebController::class,'cambiarImagen']);

//vista partidos
Route::get('/partidos',[WebController::class,'getPartidos']);

//vista partidos
Route::post('/crearPartido',[WebController::class,'crearPartido']);

//vista partidos seccion info
Route::post('/info-partido',[WebController::class,'getInfoPartido']);


//actualizacionses partido

Route::post('/actualizarObservacionPartido',[WebController::class,'actObservacionPartido']);

Route::post('/actualizarConvocar',[WebController::class,'actConvocarPartidoJugador']);


Route::post('/actualizarAsistenciaPartido',[WebController::class,'actAsistenciaPartidoJugador']);


//vista entrenamientos
Route::get('/entrenamientos',[WebController::class, 'getEntrenamientos']);

//crear entrenamiento
Route::post('/crearEntrenamiento',[WebController::class, 'crearEntrenamiento']);

//vista entrenamientos seccion info
Route::post('/info-entrenamiento',[WebController::class, 'getInfoEntrenamiento']);

Route::post('/actualizarObservacionEntrenamiento',[WebController::class, 'actObservacionEntrenamiento']);

Route::post('/actualizarConvocarEntrenamiento',[WebController::class, 'actConvocarEntrenamiento']);

Route::post('/actualizarAsistenciaEntrenamiento',[WebController::class, 'actAsistenciaEntrenamiento']);

//vista jugadores
Route::get('/jugadores',[WebController::class, 'getJugadores']);

//crear jugador
Route::post('/crearJugador',[WebController::class, 'crearJugador']);

//vista jugadroes seccion info
Route::post('/info-jugador', [WebController::class, 'getInfoJugador']);

Route::post('/actObservacionJugador', [WebController::class, 'actObservacionJugador']);


Route::get('/error', function () {
    return view('login/error');
});
