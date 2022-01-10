<?php

namespace App\Http\Controllers\ModelControllers;

use App\Exceptions\ModificacionNoAutorizadaException;

class ActualizacionController{

    /**
     * Permite actualizar el resultado y la obsercavion de un partido exclusivamente 
     * a un $idClubModificador que forma parte de dicho encuentro como local o visitante.
     * 
     * Se actualizara el resultado y la observación en función de si no nulas.
     *
     */
    public static function actualizarPartido(int $idClubModificador, int $idPartido, string $resultado = null, string $observacion = null){

        //recogemos el partido del modelo
        $partido = ConsultaController::buscarPartido($idPartido,null,null,null)[0];

        //comprobamos que el partido que ise intenta cambiar corresponde al club cmo visitante o local
        if(!(
            (int)$partido->local_id == $idClubModificador
            ||
            (int)$partido->visitante_id == $idClubModificador
           )
        ){
            throw new ModificacionNoAutorizadaException;
        }

        
        if($resultado != null){
            $partido->resultado = $resultado;
        }

        if($observacion != null){
            $partido->observacion = $observacion;
        }

        $partido->save();

    }
    
}