<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/**
 * Debe recibir
 */

//Route::post('/alta',[LoginController::class,'alta']);

Route::post('/login',[LoginController::class,'logear']);

Route::post('/user',[ApiController::class,'getInfoUsuario']);

Route::post('/partidos',[ApiController::class,'getPartidos']);

Route::post('/entrenamientos',[ApiController::class,'getEntrenamientos']);

Route::post('/jugadores',[ApiController::class,'getJugadores']);

Route::post('/convocatoriaPartido',[ApiController::class,'getConvocatoriaPartido']);

Route::post('/convocatoriaEntrenamiento',[ApiController::class,'getConvocatoriaEntrenamiento']);

Route::post('/actualizarPartido',[ApiController::class,'actPartido']);

Route::post('/actualizarEntrenamiento',[ApiController::class,'actEntrenamiento']);

Route::post('/actualizarJugador',[ApiController::class,'actJugador']);

Route::post('/actualizarConvocatoriaPartido',[ApiController::class,'actConvocatoriaPartido']);

Route::post('/actualizarConvocatoriaEntrenamiento',[ApiController::class,'actConvocatoriaEntrenamiento']);

Route::post('/insertarPartido',[ApiController::class,'insPartido']);

Route::post('/insertarEntrenamiento',[ApiController::class,'insEntrenamiento']);

Route::post('/insertarJugador',[ApiController::class,'insJugador']);

Route::post('/insertarConvocatoriaPartido',[ApiController::class,'insConvocatoriaPartido']);