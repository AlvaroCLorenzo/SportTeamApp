<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ModelControllers\ConsultaController;
use App\Http\Controllers\ModelControllers\GuardadoController;
use App\Models\Partido;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    const ARGUMENTOS_INVALIDOS = 'argumentos invalidos';
    
    public function getInfoUsuario(Request $request){

        //se valida la petición
        $idClub = LoginController::logearApi($request);

        if($idClub == null){
            return LoginController::RESPUESTA_ERROR_LOGIN;
        }


        return ConsultaController::buscarClub($idClub)[0];
        
    }

    public function getPartidos(Request $request){


        //se valida la petición
        $idClub = LoginController::logearApi($request);

        if($idClub == null){
            return LoginController::RESPUESTA_ERROR_LOGIN;
        }

        //se recogen los partidos como local y conmo visitante
        $partidos= ConsultaController::buscarPartido(null,null,null,$idClub);

        return $partidos;

    }

    public function getEntrenamientos(Request $request){


        //se valida la petición
        $idClub = LoginController::logearApi($request);

        if($idClub == null){
            return LoginController::RESPUESTA_ERROR_LOGIN;
        }

        //se recogen los entrenamientos
        $entrenamientos= ConsultaController::buscarEntrenamiento(null,$idClub);

        return $entrenamientos;

    }

    public function getJugadores(Request $request){


        //se valida la petición
        $idClub = LoginController::logearApi($request);

        if($idClub == null){
            return LoginController::RESPUESTA_ERROR_LOGIN;
        }

        //se recogen todos los jugadores
        $entrenamientos= ConsultaController::buscarJugador(null,$idClub,null,null);

        return $entrenamientos;

    }

    public function getConvocatoriaPartido(Request $request){

        //se valida la petición
        $idClub = LoginController::logearApi($request);

        if($idClub == null){
            return LoginController::RESPUESTA_ERROR_LOGIN;
        }

        if(!isset($request->idPartido)){
            return self::ARGUMENTOS_INVALIDOS;
        }

        $registrosComvocatoriaPartido = ConsultaController::buscarAsistencia_partido(null,(int)$request->idPartido);

        return $registrosComvocatoriaPartido;

    }

    public function getConvocatoriaEntrenamiento(Request $request){

        //se valida la petición
        $idClub = LoginController::logearApi($request);

        if($idClub == null){
            return LoginController::RESPUESTA_ERROR_LOGIN;
        }

        if(!isset($request->idEntrenamiento)){
            return self::ARGUMENTOS_INVALIDOS;
        }

        $registrosComvocatoriaEntrenamiento = ConsultaController::buscarAsistencia_entrenamiento(null,(int)$request->idEntrenamiento);

        return $registrosComvocatoriaEntrenamiento;

    }

    public function actPartido(Request $request){
        
        //se valida la petición
        $idClub = LoginController::logearApi($request);

        if($idClub == null){
            return LoginController::RESPUESTA_ERROR_LOGIN;
        }

        
    }

}
