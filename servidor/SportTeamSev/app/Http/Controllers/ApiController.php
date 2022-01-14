<?php

namespace App\Http\Controllers;

use App\Exceptions\FormatoParametroIncorrectoException;
use App\Exceptions\UsoIncorrectoSobrecargaException;
use App\Http\Controllers\ModelControllers\ActualizacionController;
use App\Http\Controllers\ModelControllers\ConsultaController;
use App\Http\Controllers\ModelControllers\GuardadoController;
use App\Models\Partido;
use Illuminate\Http\Request;
use App\Exceptions\ModificacionNoAutorizadaException;

class ApiController extends Controller
{
    const ARGUMENTOS_INVALIDOS = 'argumentos invalidos';

    const ACTUALIZACION_EXITOSA = 'actualizacion existosa';

    const ERROR_GENERICO = 'error';
    
    public function getInfoUsuario(Request $request){

        //se valida la petición
        $idClub = LoginController::logearApi($request);

        if($idClub == null){
            return LoginController::RESPUESTA_ERROR_LOGIN;
        }

        try{

            return ConsultaController::buscarClub($idClub)[0];

        }catch(
                FormatoParametroIncorrectoException
                |
                UsoIncorrectoSobrecargaException
            $ex
        ){
            return self::ERROR_GENERICO;
        }
        
    }

    public function getPartidos(Request $request){


        //se valida la petición
        $idClub = LoginController::logearApi($request);

        if($idClub == null){
            return LoginController::RESPUESTA_ERROR_LOGIN;
        }

        
        try{

            //se recogen los partidos como local y conmo visitante
            $partidos= ConsultaController::buscarPartido(null,null,null,$idClub);

             return $partidos;

        }catch(
                FormatoParametroIncorrectoException
                |
                UsoIncorrectoSobrecargaException
            $ex
        ){
            return self::ERROR_GENERICO;
        }

    }

    public function getEntrenamientos(Request $request){


        //se valida la petición
        $idClub = LoginController::logearApi($request);

        if($idClub == null){
            return LoginController::RESPUESTA_ERROR_LOGIN;
        }

        try{

            //se recogen los entrenamientos
            $entrenamientos= ConsultaController::buscarEntrenamiento(null,$idClub);

            return $entrenamientos;

        }catch(
                FormatoParametroIncorrectoException
                |
                UsoIncorrectoSobrecargaException
            $ex
        ){
            return self::ERROR_GENERICO;
        }

    }

    public function getJugadores(Request $request){


        //se valida la petición
        $idClub = LoginController::logearApi($request);

        if($idClub == null){
            return LoginController::RESPUESTA_ERROR_LOGIN;
        }

        //se recogen todos los jugadores

        try{

            $entrenamientos= ConsultaController::buscarJugador(null,$idClub,null,null);

            return $entrenamientos;

        }catch(
                FormatoParametroIncorrectoException
                |
                UsoIncorrectoSobrecargaException
            $ex
        ){
            return self::ERROR_GENERICO;
        }

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

        try{

            $registrosComvocatoriaPartido = ConsultaController::buscarAsistencia_partido(null,(int)$request->idPartido);

            return $registrosComvocatoriaPartido;

        }catch(
                FormatoParametroIncorrectoException
                |
                UsoIncorrectoSobrecargaException
            $ex
        ){
            return self::ERROR_GENERICO;
        }

        

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

        try{

            $registrosComvocatoriaEntrenamiento = ConsultaController::buscarAsistencia_entrenamiento(null,(int)$request->idEntrenamiento);

            return $registrosComvocatoriaEntrenamiento;

        }catch(
                FormatoParametroIncorrectoException
                |
                UsoIncorrectoSobrecargaException
                $ex
        ){
            return self::ERROR_GENERICO;
        }

    }

    /**
     * Permite actualizar el resultado y la obsercavion de un partido exclusivamente 
     * a un club que forma parte de dicho encuentro.
     * 
     * Para eso el request debe de tener dichos argumentos:
     * resultado & observacion
     * 
     * 
     */
    public function actPartido(Request $request){
        
        //se valida la petición
        $idClub = LoginController::logearApi($request);

        if($idClub == null){
            return LoginController::RESPUESTA_ERROR_LOGIN;
        }

        if(!isset($request->idPartido)){
            return self::ARGUMENTOS_INVALIDOS;
        }

        
        $resultado = isset($request->resultado) ? $request->resultado : null;

        $observacion = isset($request->observacion) ? $request->observacion : null;

        
        try{

            ActualizacionController::actualizarPartido($idClub, (int)$request->idPartido, $resultado, $observacion);

            return self::ACTUALIZACION_EXITOSA;

        }catch(ModificacionNoAutorizadaException $ex){

            return $ex->getMessage();

        }
    }

}
