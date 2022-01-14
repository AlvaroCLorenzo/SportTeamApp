<?php

namespace App\Http\Controllers;

use App\Exceptions\ClaveForaneaNullaException;
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

        //si no existe el argumento necesario se retorna error
        if(!isset($request->idPartido)){
            return self::ARGUMENTOS_INVALIDOS;
        }

        
        $resultado = isset($request->resultado) ? $request->resultado : null;

        $observacion = isset($request->observacion) ? $request->observacion : null;

        
        try{

            ActualizacionController::actualizarPartido($idClub, (int)$request->idPartido, $resultado, $observacion);

            return self::ACTUALIZACION_EXITOSA;

        }catch(ModificacionNoAutorizadaException | UsoIncorrectoSobrecargaException
         $ex){

            return $ex->getMessage();

        }
    }


    public function actEntrenamiento(Request $request){

        //se valida la petición
        $idClub = LoginController::logearApi($request);

        if($idClub == null){
            return LoginController::RESPUESTA_ERROR_LOGIN;
        }

        if(!isset($request->idEntrenamiento)){
            return self::ARGUMENTOS_INVALIDOS;
        }

        $observacion = isset($request->observacion) ? $request->observacion : null;

        try{

            ActualizacionController::actualizarEntrenamiento($idClub, $request->idEntrenamiento, $observacion);

            return self::ACTUALIZACION_EXITOSA;

        }catch(ModificacionNoAutorizadaException | UsoIncorrectoSobrecargaException
        $ex){

            return $ex->getMessage();

        }
    }

    public function actJugador(Request $request){

        //se valida la petición
        $idClub = LoginController::logearApi($request);

        if($idClub == null){
            return LoginController::RESPUESTA_ERROR_LOGIN;
        }

        if(!isset($request->idJugador)){
            return self::ARGUMENTOS_INVALIDOS;
        }

        $observacion = isset($request->observacion) ? $request->observacion : null;

        try{

            ActualizacionController::actualizarEntrenamiento($idClub, $request->idJugador, $observacion);

            return self::ACTUALIZACION_EXITOSA;

        }catch(ModificacionNoAutorizadaException | UsoIncorrectoSobrecargaException
         $ex){

            return $ex->getMessage();

        }
    }


    /**
     * Permite actualizar los campos de asistido y justificado de un registro de convocatoria a un partido
     */

    public function actConvocatoriaPartido(Request $request){


        //se valida la petición
        $idClub = LoginController::logearApi($request);

        if($idClub == null){
            return LoginController::RESPUESTA_ERROR_LOGIN;
        }

         //si no existe el argumento necesario se retorna error
        if(!isset($request->idConvocatoria)){
            return self::ARGUMENTOS_INVALIDOS;
        }


        //se comprueba si existe el argumento asistido en la peticion y su valor
        $asistido = null;

        if(isset($request->asistido)){

            $asistido = (strcmp($request->asistido,'true')==0) ? true : false;
            
        }


        //se comprueba si existe el argumento justificado en la peticion y su valor
        $justificado = null;

        if(isset($request->justificado)){

            $justificado = (strcmp($request->justificado,'true')==0) ? true : false;

        }

        
        try{

            ActualizacionController::actualizarConvocatoriaPartido($idClub, (int)$request->idConvocatoria, $asistido, $justificado);

            return self::ACTUALIZACION_EXITOSA;

        }catch(ModificacionNoAutorizadaException $ex){

            return $ex->getMessage();

        }

    }



    /**
     * Permite actualizar los campos de asistido y justificado de un registro de convocatoria a un entrenamiento
     */

    public function actConvocatoriaEntrenamiento(Request $request){

        //se valida la petición
        $idClub = LoginController::logearApi($request);

        if($idClub == null){
            return LoginController::RESPUESTA_ERROR_LOGIN;
        }

         //si no existe el argumento necesario se retorna error
        if(!isset($request->idConvocatoria)){
            return self::ARGUMENTOS_INVALIDOS;
        }


        //se comprueba si existe el argumento asistido en la peticion y su valor
        $asistido = null;

        if(isset($request->asistido)){

            $asistido = (strcmp($request->asistido,'true')==0) ? true : false;
            
        }


        //se comprueba si existe el argumento justificado en la peticion y su valor
        $justificado = null;

        if(isset($request->justificado)){

            $justificado = (strcmp($request->justificado,'true')==0) ? true : false;

        }

        
        try{

            ActualizacionController::actualizarConvocatoriaEntrenamiento($idClub, (int)$request->idConvocatoria, $asistido, $justificado);

            return self::ACTUALIZACION_EXITOSA;  

        }catch(ModificacionNoAutorizadaException $ex){

            return $ex->getMessage();

        }

    }


    /**
     * Permite insertar un partido.
     */
    public function insPartido(Request $request){

        //se valida la petición
        $idClub = LoginController::logearApi($request);

        if($idClub == null){
            return LoginController::RESPUESTA_ERROR_LOGIN;
        }

        
        if(!isset($request->eqLocal) || !isset($request->eqVisitante) || !isset($request->fechaHora)){
            return self::ARGUMENTOS_INVALIDOS;
        }

        
        //se comprueba si el club logueado es uno de los dos participantes del partido
        if($idClub != (int)ConsultaController::buscarClub($request->eqLocal)[0]->id
           &&
           $idClub != (int)ConsultaController::buscarClub($request->eqVisitante)[0]->id
        ){
            return (new ModificacionNoAutorizadaException())->getMessage();
        }

        
        $competicion = isset($request->competicion) ? $request->competicion : null;
        
        try{

            GuardadoController::guardarPartido($request->eqLocal, $request->eqVisitante, $competicion, $request->fechaHora, null, null);

            return self::ACTUALIZACION_EXITOSA; 

        }catch(ClaveForaneaNullaException | FormatoParametroIncorrectoException
        $ex){

            return $ex->getMessage();

        }
    
    }

}
