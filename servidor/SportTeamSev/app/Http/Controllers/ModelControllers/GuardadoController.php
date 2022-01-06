<?php

namespace App\Http\Controllers\ModelControllers;

use App\Exceptions\ClaveForaneaNullaException;
use App\Exceptions\FormatoParametroIncorrectoException;

use App\Models\Club;
use App\Models\Categoria;
use App\Models\Competicione;
use App\Models\Entrenamiento;
use App\Models\Partido;
use Illuminate\Database\Eloquent\Model;

/**
 * Clase para el guardado de registros en el modelo.
 * 
 * La clase está pensada para realizar guardados sin tener que buscar manualmente las 
 * claves primarias de las claves foraneas de los registros a guardar, en su lugar solo se 
 * manda el nombre identificador principal y el metodo se encarga de encontrar la clave foranea
 * y guardarla con integridad referencial.
 * 
 * Para los métodos se usa la excepción ClaveForaneaNullaException para indicar si no se han
 * encontrado registros con el nombre de la clave foránea en las tablas de las que depende el 
 * guardado de un registro.
 */

class GuardadoController
{

    //string para identificar al campo id canonico en la base de datos
    const ID = 'id';

    public static function guardarCategoria(string $nombre){

        $categoria = new Categoria();
        $categoria->nombreCategoria = $nombre;
        $categoria->save();

    }

    

    public static function guardarCompeticion(string $nombre){

        $competicion = new Competicione();
        $competicion->nombreCompeticion = $nombre;
        $competicion->save();

    }
    


    public static function guardarClub(string $nombre, string $password, string $deporte, string $temporada, $categoria){


        $resultado = GuardadoController::buscarIDModelo(Categoria::class, $categoria, 'nombreCategoria');

        
        //en este punto $categoria no puede ser null

        //si no se encuentra la categoría en la consulta que se ha realizado se lanza una excepcion
        if(count($resultado)==0){
            throw new ClaveForaneaNullaException(['$categoria']);
        }
       
        //cogemos el primer resultado, no debería haber más
        $categoriaRelacionada = $resultado[0];

        $club = new Club();
        $club->nombre = $nombre;
        $club->password = $password;
        $club->deporte = $deporte;
        $club->temporada = $temporada;

        $categoriaRelacionada->clubs()->save($club);

        $club->save();

    }



    public static function guardarEntrenamiento($club, string $fechaHora,  $duracion, string $lugar,string $observacion = null){


        $resultado = GuardadoController::buscarIDModelo(Club::class, $club, 'nombre');

        
        //en este punto $club no puede ser null

        //si no se encuentra la club en la consulta que se ha realizado se lanza una excepcion
        if(count($resultado)==0){
            throw new ClaveForaneaNullaException(['$club']);
        }
       
        //cogemos el primer resultado, no debería haber más
        $clubRelacionado = $resultado[0];

        $entrenamiento = new Entrenamiento();

        $entrenamiento->fechaHora = $fechaHora;
        $entrenamiento->duracion = $duracion;
        $entrenamiento->lugar = $lugar;

        //solo se pone obsrvacion si no es nula
        if($observacion != null){
            $entrenamiento->observacion = $observacion;
        }
 
        $clubRelacionado->entrenamientos()->save($entrenamiento);

        $entrenamiento->save();

    }


    public static function guardarPartido($clubLocal, $clubVisitante, $idCompeticion = null, string $fechaHora, string $resultado = null ,string $observacion = null){


        $resultadoClubLocal = GuardadoController::buscarIDModelo(Club::class, $clubLocal, 'nombre');

        $resultadoClubVisitante = GuardadoController::buscarIDModelo(Club::class, $clubVisitante, 'nombre');


        $resultadoCompeticion = null;

        if($idCompeticion != null){

            $resultadoCompeticion = GuardadoController::buscarIDModelo(Competicione::class, $idCompeticion, 'nombreCompeticion');

        }
        
        
        //comprobamos que han existido resultados a la hora de buscar las referencias objeto de las claves foraneas
        $hayClaveForaneaNulla = false;

        $clavesForaneasFallidas = array();
        
        //si no se encuentran resultados para el club local se añade es referencia a la excepcion
        if(count($resultadoClubLocal)==0){
            $hayClaveForaneaNulla = true;
            array_push($clavesForaneasFallidas,'$clubLocal');
        }

        //si no se encuentran resultados para el club visitante
        if(count($resultadoClubVisitante)==0){
            $hayClaveForaneaNulla = true;
            array_push($clavesForaneasFallidas,'$clubVisitante');
        }

        if( $resultadoCompeticion != null && count($resultadoCompeticion)==0){
            $hayClaveForaneaNulla = true;
            array_push($clavesForaneasFallidas,'$idCompeticion');
        }

        if($hayClaveForaneaNulla){
            throw new ClaveForaneaNullaException($clavesForaneasFallidas);
        }


       
        /*cogemos el primer resultado del array de resultados, es un array por el restorno 
        de la consulta pero solo debería haber un elemento en el indice 0 del array si se 
        conserva bien la integridad referencial.
        */

        $clubLocalRelacionado = $resultadoClubLocal[0];
        $clubVisitanteRelacionado = $resultadoClubVisitante[0];

        $competicionRelacionado = null;

        if($resultadoCompeticion != null){
            $competicionRelacionado = $resultadoCompeticion[0];
        }

        //creamos el objeto partido
        $partido= new Partido();

        //guardamos los datos estáticos
        $partido->fechaHora = $fechaHora;

        if($resultado != null){
            $partido->resultado = $resultado;
        }

        //solo se pone obsrvacion si no es nula
        if($observacion != null){
            $partido->observacion = $observacion;
        }
 
        //creamos las relaciones en el modelo
        $clubLocalRelacionado->partidos('local')->save($partido);

        $clubVisitanteRelacionado->partidos('visitante')->save($partido);

        if($competicionRelacionado != null){
            $competicionRelacionado->partidos()->save($partido);
        }

        $partido->save();

    }


    

    private static function buscarIDModelo($claseModelo, $idOValor, $nombreCampo){


        

        //array de resultados de la consulta
        $resultado = null;

        //si el parametro $idOValor es string se busca por el campo nombre de la tabla del modelo que indique la clase $claseModelo
        if(is_string($idOValor)){

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


    



    

    

}