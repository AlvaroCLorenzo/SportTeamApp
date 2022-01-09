<?php

namespace App\Http\Controllers\ModelControllers;

use App\Exceptions\FormatoParametroIncorrectoException;
use App\Exceptions\UsoIncorrectoSobrecargaException;
use App\Models\Asistencia_entrenamiento;
use App\Models\Asistencia_partido;
use App\Models\Categoria;
use App\Models\Club;
use App\Models\Competicione;
use App\Models\Entrenamiento;
use App\Models\Jugadore;
use App\Models\Partido;

class ConsultaController
{

    const ID = 'id';

    /**
     * Permite buscar en una clase del modelo cualquiera por un un id o el valor de un campo.
     * Es una consulta simple con una clausula where u retorna un array de objetos del modelo.
     * 
     * El $idOValor puede ser un int, en cuyo caso se presupone que la busqueda es por id.
     * 
     * El $idOValor puede ser un string, en cuyo caso se presupone que la busqueda es por 
     * el $mombreCampo que es el nombre del camo por el que se quiere buscar el $idOValor.
     */
    public static function buscarIDModelo($claseModelo, $idOValor, $nombreCampo = null){

        //array de resultados de la consulta
        $resultado = null;

        //si el parametro $idOValor es string y se ha recibido un $nombreCampo se busca por el campo $nombreCampo de la tabla del modelo que indique la clase $claseModelo
        if(is_string($idOValor) && $nombreCampo != null){

            /*
                Lo que hace la expresión call_user_func es llamar al metodo de la segunda posicion del array 
                de la clase conrrespondiente con el nombre (string) del primer parametro del array , el resto 
                de parametros del array son los parametros normales que recibiría dicho método indicado en el
                array.
            */
            $resultado = call_user_func( array($claseModelo, 'where'), $nombreCampo,'=',$idOValor)->get();
    
        //si es un numero entero se busca por id
        }else if(is_int($idOValor)){
            //si el valor de busqueda es un numero entero se da por supuesto que se quiere buscar por el id
            $resultado = call_user_func( array($claseModelo, 'where'), self::ID,'=',$idOValor)->get();

        }else{

            //si el id de busqueda ya sea por un campo o por el id no es ni string ni int es que tiene un tipado incorrecto en la variable
            throw new FormatoParametroIncorrectoException([$nombreCampo]);

        }

        return $resultado;

    }

    /**
     * permite buscar un club por su id o por su nombre.
     */
    public static function buscarClub($club){

        return self::buscarIDModelo(Club::class, $club, 'nombre');
        
    }

    /**
     * permite buscar una categoria por su id o por su nombre.
     */
    public static function buscarCategoria($categoria){

        return self::buscarIDModelo(Categoria::class, $categoria, 'nombreCategoria');

    }

    /**
     * permite buscar una competicion por su id o por su nombre.
     */
    public static function buscarCompeticion($competicion){

        return self::buscarIDModelo(Competicione::class, $competicion, 'nombreCompeticion');
        
    }

    /**
     * permite buscar un entrenamiento por su id.
     * Pasando solo $idEntrenamiento.
     * o
     * permite buscar todos los entrenamientos de un club por su id.
     * Pasando solo $idClub.
     *
     */
    public static function buscarEntrenamiento(int $idEntrenamiento = null, int $idClub = null){

        if($idEntrenamiento != null){

            return self::buscarIDModelo(Entrenamiento::class, $idEntrenamiento);

        }else if($idClub != null){

            return Entrenamiento::where('club_id','=',$idClub)
                                  ->get();

        }
        
    }

    /**
     * Permite buscar un partido por su id.
     * Pasando solo $idPartido.
     * o
     * Permite buscar todos los partidos en los que está involucrado un club como local.
     * Pasando solo $idClubLocal.
     * o
     * Permite buscar todos los partidos en los que está involucrado un club como visitante.
     * Pasando solo $idClubVisitante.
     * o
     * Permite buscar todos los partidos en lso que está involucrado un club en ambos roles (visitante y local)
     * PAsando solo $ambos
     */
    public static function buscarPartido(int $idPartido = null, int $idClubLocal = null, int $idClubVisitante = null,int $ambos=null){

        //bvusqueda solo por el idPartido
        if($idPartido != null){

            return self::buscarIDModelo(Partido::class, $idPartido);

        //busqueda de todos los partidos de una combinacion visitante local
        }else if($idClubLocal != null && $idClubVisitante != null){

            return Partido::where('local_id','=',$idClubLocal)
                          ->where('visitante_id','=',$idClubVisitante)
                          ->orderBy('fechaHora','DESC')
                          ->get();


        }else if($idClubLocal != null){

            return Partido::where('local_id','=',$idClubLocal)
                          ->orderBy('fechaHora','DESC')
                          ->get();

        }else if($idClubVisitante != null){

            return Partido::where('visitante_id','=',$idClubVisitante)
                          ->orderBy('fechaHora','DESC')
                          ->get();

        }else if($ambos != null){

        return Partido::where('visitante_id','=',$ambos)
                      ->orWhere('local_id','=',$ambos)
                      ->orderBy('fechaHora','DESC')
                      ->get();
        }else{
            throw new UsoIncorrectoSobrecargaException();
        }
        
    }

    /**
     * Permite buscar un jugador por su id. 
     * Pasando solo $idJugador.
     * o
     * Permite buscar por el id del club al que pertenece, su nombre y sus apellidos.
     * Pasando solo $idClub, $nombre, $apellidos.
     * o
     * Permite buscar todos los jugadores de un club.
     * Pasando solo $idClub.
     * 
     * 
     */
    public static function buscarJugador(int $idJugador = null, int $idClub = null, string $nombre = null, string $apellidos = null){

        //consulta por id
        if($idJugador != null){

            return self::buscarIDModelo(Jugadore::class, $idJugador);

        //consulta por idClub, nombre y apellidos
        }else if($idClub != null && $nombre != null && $apellidos != null){
        
            return Jugadore::where('club_id','=',$idClub)
                           ->where('nombre','=',$nombre)
                           ->where('apellidos','=',$apellidos)
                           ->get();

        //buscar los todos los jugadores de un
        }else if($idClub != null){

            return Jugadore::where('club_id','=',$idClub)
                           ->get();

        }else{    
            throw new UsoIncorrectoSobrecargaException();
        }

    }

    

    /**
     * permite buscar un registro de asistencia a partidos por su id.
     */
    public static function buscarAsistencia_partido(int $idAsistancia_partido){

        return self::buscarIDModelo(Asistencia_partido::class, $idAsistancia_partido);
        
    }

    /**
     * permite buscar un registro de asistencia a entrenamientos por su id.
     */
    public static function buscarAsistencia_entrenamiento(int $idAsistancia_entrenamiento){

        return self::buscarIDModelo(Asistencia_entrenamiento::class, $idAsistancia_entrenamiento);
        
    }






    

}