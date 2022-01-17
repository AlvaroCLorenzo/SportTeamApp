<?php

namespace App\Http\Controllers\ModelControllers;

use App\Exceptions\ModificacionNoAutorizadaException;

class ActualizacionController{



    public static function actualizarPathImagenClub(int $idClub, string $nuvaImagenPath){

        $clubResultado = ConsultaController::buscarClub($idClub, null);

        $club = $clubResultado[0];

        $club->pathImagen = $nuvaImagenPath;

        $club->save();

    }
    
    /**
     * Permite actualizar el resultado y la obsercavion de un partido exclusivamente 
     * a un $idClubModificador que forma parte de dicho encuentro como local o visitante.
     * 
     * Se actualizara el resultado y la observación en función de si no nulas.
     *
     */
    public static function actualizarPartido(int $idClubModificador, int $idPartido, string $resultado = null, string $observacion = null){

        
        //comprobamos que el partido que se intenta cambiar corresponde al club como visitante o local, por ende puede modificarlo
        if(!self::comprobarPermisoModificacionPartido($idClubModificador, $idPartido)){
            throw new ModificacionNoAutorizadaException();
        }

        //recogemos el partido del modelo
        $partido = ConsultaController::buscarPartido($idPartido,null,null,null)[0];
        
        //modificamos sus campos
        if($resultado != null){
            $partido->resultado = $resultado;
        }

        if($observacion != null){
            $partido->observacion = $observacion;
        }

        $partido->save();

    }

    public static function actualizarEntrenamiento(int $idClubModificador, int $idEntrenamiento, string $observacion = null){

        $entrenamiento = ConsultaController::buscarEntrenamiento($idEntrenamiento,null)[0];

        if($idClubModificador !== (int)$entrenamiento->club_id){
            throw new ModificacionNoAutorizadaException();
        }

        if($observacion != null){

            $entrenamiento->observacion = $observacion;

        }

        $entrenamiento->save();

    }

    public static function actualizarJugador(int $idClubModificador, int $idJugador, string $observacion = null){

        $jugador = ConsultaController::buscarJugador($idJugador,null,null,null)[0];

        if($idClubModificador !== (int)$jugador->club_id){
            throw new ModificacionNoAutorizadaException();
        }

        if($observacion != null){

            $jugador->observacion = $observacion;

        }

        $jugador->save();

    }

    /**
     * Permite actualizar los cmpos asistido y justificado de un registro
     *  de asistencia a partido, hay recibir en el request obligatoriamente el 
     * $idClubModificador y el $idComvocatoriaPartido y el campo $asistido
     *  y $justificado son opcionales en el request.
     * 
     * Se comprueba si el club que intenta hacer la modificación es parte de 
     * partido de la combocatoria que se pretende modificar y por lo tanto puede 
     * hacer dicha modificación.
     */
    public static function actualizarConvocatoriaPartido(int $idClubModificador, int $idComvocatoriaPartido, bool $asistido = null, bool $justificado = null){
        
        
        $comvocatoriaPartido = ConsultaController::buscarAsistencia_partido($idComvocatoriaPartido)[0];
        
        /*se comprueba si el club que está realizando la modificación puede modificar ese registro
         mirando si el partido al que pertenece este registro de comvocatoria pertenece a el club 
         que lo intenta modiciar.
        */
        
        if(!self::comprobarPermisoModificacionPartido($idClubModificador, $comvocatoriaPartido->partido_id)){
            throw new ModificacionNoAutorizadaException();
        }

        

        if($asistido !== null){
            $comvocatoriaPartido->asistido = $asistido;
        }
        
        
        if($justificado !== null){
            $comvocatoriaPartido->justificado = $justificado;
        }

        $comvocatoriaPartido->save();

    }

    /**
     * Comprueba que un id de un club tiene permiso para modificar un partido por que es un visitante o un local
     */
    private static function comprobarPermisoModificacionPartido(int $idClub, int $idPartido){

        //recogemos el partido del modelo
        $partido = ConsultaController::buscarPartido($idPartido,null,null,null)[0];

        return (
            (int)$partido->local_id == $idClub
            ||
            (int)$partido->visitante_id == $idClub
        );

    }

    public static function actualizarConvocatoriaEntrenamiento(int $idClubModificador, int $idConvocatoriaEntrenamiento, bool $asistido = null, bool $justificado = null){
        
        //se busca el registro que se quiere modificar
        $convocatoriaEntrenamiento = ConsultaController::buscarAsistencia_entrenamiento($idConvocatoriaEntrenamiento, null)[0];

        //se busca al entrenamiento al que hace referencia el registro de la convocatoria
        $entrenamientoReferenciado = ConsultaController::buscarEntrenamiento((int)$convocatoriaEntrenamiento->entrenamiento_id,null)[0];
        
        /*si el id del club modificador es distinto al id del club al que pertenece 
        el entrenamiento al que pertenece el registro de la convocatoria salta la 
        excepcion de modificación no autorizada*/

        if($idClubModificador != (int)$entrenamientoReferenciado->club_id){
            throw new ModificacionNoAutorizadaException();
        }


        if($asistido !== null){
            $convocatoriaEntrenamiento->asistido = $asistido;
        }
        
        
        if($justificado !== null){
            $convocatoriaEntrenamiento->justificado = $justificado;
        }

        $convocatoriaEntrenamiento->save();

    }

    
}