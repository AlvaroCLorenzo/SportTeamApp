<?php

namespace App\Http\Controllers\ModelControllers;

use App\Exceptions\ClaveForaneaNullaException;
use App\Exceptions\InsercionDuplicadaException;
use App\Exceptions\ModificacionNoAutorizadaException;
use App\Models\Asistencia_entrenamiento;
use App\Models\Asistencia_partido;
use App\Models\Club;
use App\Models\Categoria;
use App\Models\Competicione;
use App\Models\Entrenamiento;
use App\Models\Jugadore;
use App\Models\Partido;


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

   

    
    /**
     * Permite insertar una categoría en el modelo.
     * 
     * El campo nombreCategoría debe ser único en la tabla.
     */
    public static function guardarCategoria(string $nombre){

        //si ya existe una categoría con el mismo nombre salta una excepcion del tipo InsercionDuplicadaException
        self::comprobarDuplicado(ConsultaController::buscarCategoria($nombre),'$nombre');
        
        $categoria = new Categoria();
        $categoria->nombreCategoria = $nombre;
        $categoria->save();

    }


    /**
     * Permite insertar una competición en el modelo.
     * 
     * El campo nombreCompeticion debe ser único en la tabla.
     */
    public static function guardarCompeticion(string $nombre){

        //si ya existe una competición con el mismo nombre salta una excepcion del tipo InsercionDuplicadaException
        self::comprobarDuplicado(ConsultaController::buscarCompeticion($nombre),'$nombre');

        $competicion = new Competicione();
        $competicion->nombreCompeticion = $nombre;
        $competicion->save();

    }
    

    /**
     * Permite insertar un club en el modelo.
     * 
     * El campo nombre debe ser único en la tabla.
     */
    public static function guardarClub(string $nombre, string $password=null, string $deporte=null, string $temporada=null, $categoria = null){

        //si ya existe un club con el mismo nombre y contraseña salta una excepcion del tipo InsercionDuplicadaException
        self::comprobarDuplicado(ConsultaController::buscarClub($nombre, $password),'$nombre $contraseña');

        $categoriaRelacionada = null;

        if($categoria != null){

            $resultado = ConsultaController::buscarCategoria($categoria);
        
            //en este punto $categoria no puede ser null
            //si no se encuentra la categoría en la consulta que se ha realizado se lanza una excepcion
            if(count($resultado)==0){
                throw new ClaveForaneaNullaException(['$categoria']);
            }

            //cogemos el primer resultado, no debería haber más
            $categoriaRelacionada = $resultado[0];


        }

        //miramos si ya existe un club dado de alta con la contraseña nola, es decir, un club que no ha sido recoalamdo por nadie
        $clubHuerfano = ConsultaController::buscarClub($nombre);

        //si se ha encontrado un club huerfano
        if(count($clubHuerfano)>0){

            $club = $clubHuerfano[0];
        }else{

            $club = new Club();
        }

        $club->nombre = $nombre;
        $club->password = $password;
        $club->deporte = $deporte;
        $club->temporada = $temporada;

        

        if($categoriaRelacionada != null){

            $categoriaRelacionada->clubs()->save($club);

        }
        

        $club->save();

    }


    /**
     * Permite insertar un entrenamiento en el modelo.
     * 
     * Está permitido el duplicado de registros.
     * 
     */
    public static function guardarEntrenamiento($club, string $fechaHora,float  $duracion, string $lugar,string $observacion = null){


        $resultado = ConsultaController::buscarClub($club);

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

    /**
     * Permite insertar un partido en el modelo.
     * 
     * Está permitido el duplicado de registros.
     */
    public static function guardarPartido($clubLocal, $clubVisitante, $competicion = null, string $fechaHora, string $resultado = null ,string $observacion = null){

        $resultadoClubLocal = ConsultaController::buscarClub($clubLocal);

        $resultadoClubVisitante = ConsultaController::buscarClub($clubVisitante);

        $resultadoCompeticion = null;

        if($competicion != null){

            $resultadoCompeticion = ConsultaController::buscarCompeticion($competicion);

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

        //si alguna clave foranea no ha obtenido resultados en la consulta de su modelo se lanza la excepción
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

    /**
     * Permite insertar un jugador en el modelo.
     * 
     * La combinaciónnombre de nombre y  apellidos de un jugador deben de ser únicos 
     * para un club en la tabla.
     * 
     */
    public static function guardarJugador($club, string $nombre, string $apellidos, string $telefono, string $fechaNacimiento,string $observacion = null){

        //en este caso hay que obtener el club relacionado antes para usarlo en la comprobación de duplicados
        $resultadoClub = ConsultaController::buscarClub($club);

        if(count($resultadoClub)==0){
            throw new ClaveForaneaNullaException(['$club']);
        }

        $clubRelacionado = $resultadoClub[0];

        /*
            Para hacer la comprobación de registro duplicado debe se sacarse el club_id del $club 
            del parametro, si este es un int no hace falta hacer nada por que ya es el id del club 
            pero si es un string hay que buscar el id de dicho club.

        */

        
        $idClub = null;

        if(is_int($club)){
            $idClub = $club;
        }else if(is_string($club)){
            $idClub = $clubRelacionado->id;
        }

        //se comprueba si ya exite un jugador del mismo club con el mismo nombre y apellidos
        self::comprobarDuplicado(ConsultaController::buscarJugador(null, $idClub, $nombre, $apellidos), '$club, $nombre , $apellidos');

        //se instancia jugador
        $jugador = new Jugadore();

        $jugador->nombre = $nombre;

        $jugador->apellidos = $apellidos;

        $jugador->telefono = $telefono;

        $jugador->fechaNacimiento = $fechaNacimiento;

        if($observacion != null){
            $jugador->observacion = $observacion;
        }

        $clubRelacionado->jugadores()->save($jugador);

        $jugador->save();
    }

    /**
     * Permite insertar un registro de asistencia a un entrenamiento.
     * 
     * Está permitido el duplicado de registros.
     * 
     * En este caso no se permite buscar el entrenamiento y el jugador por el nombre de 
     * su  campo en la base de datos, solo por id, por eso se fuerzan las keys como enteros.
     */
    public static function guardarAsistenciaEntrenamientos(int $idClubModificador, int $idEntrenamiento,int $idJugador, bool $asistido = null, bool $justificado = null){

        $resultadoEntrenamiento = ConsultaController::buscarEntrenamiento($idEntrenamiento);

        $resultadoJugador = ConsultaController::buscarJugador($idJugador, null, null, null);

        //comprobamos que haya un resultado para la busqueda de los objetos de las claves foraneas

        $hayClaveForaneaNulla = false;

        $clavesForaneasFallidas = array();
        
        //si no se encuentran resultados para el club local se añade es referencia a la excepcion
        if(count($resultadoEntrenamiento)==0){
            $hayClaveForaneaNulla = true;
            array_push($clavesForaneasFallidas,'$idEntrenamiento');
        }

        if(count($resultadoJugador)==0){
            $hayClaveForaneaNulla = true;
            array_push($clavesForaneasFallidas,'$idJugador');
        }


        //si alguna clave foranea no ha obtenido resultados en la consulta de su modelo se lanza la excepción
        if($hayClaveForaneaNulla){
            throw new ClaveForaneaNullaException($clavesForaneasFallidas);
        }

        //recogemos los resultados del indice 0 de las consultas, en este punto ya nos hemos asegurado que tienen al menos 1 resultado

        $entrenamientoRelacionado = $resultadoEntrenamiento[0];

        $jugadorRelacionado = $resultadoJugador[0];

        //comprobamos que el club modificador tiene permiso de modificación en dicho partido y jugador
        if( 
            $idClubModificador != (int)$jugadorRelacionado->club_id
        ||  
            $idClubModificador != (int)$entrenamientoRelacionado->club_id
        )
        {
            throw new ModificacionNoAutorizadaException();
        }



        $asistanciaEntrenamiento = new Asistencia_entrenamiento();

        if($asistido != null){
            $asistanciaEntrenamiento->asistido = $asistido;
        }

        if($justificado != null){
            $asistanciaEntrenamiento->justificado = $justificado;
        }

        $entrenamientoRelacionado->asistencia_entrenamiento()->save($asistanciaEntrenamiento);

        $jugadorRelacionado->asistencia_entrenamiento()->save($asistanciaEntrenamiento);

        $asistanciaEntrenamiento->save();

    }

    /**
     * Permite insertar un registro de asistencia a un partido.
     * 
     * Está permitido el duplicado de registros.
     * 
     * En este caso no se permite buscar el entrenamiento y el jugador por el nombre de un campo, solo por id, por eso se fuerzan las keys como enteros
     */
    public static function guardarAsistenciaPartidos(int $idClubModificador, int $idPartido,int $idJugador, bool $asistido = null, bool $justificado = null){

        $resultadoPartido = ConsultaController::buscarPartido($idPartido);

        $resultadoJugador = ConsultaController::buscarJugador($idJugador,null,null,null);

        //comprobamos que haya un resultado para la busqueda de los objetos de las claves foraneas

        $hayClaveForaneaNulla = false;

        $clavesForaneasFallidas = array();
        
        //si no se encuentran resultados para el club local se añade es referencia a la excepcion
        if(count($resultadoPartido)==0){
            $hayClaveForaneaNulla = true;
            array_push($clavesForaneasFallidas,'$idPartido');
        }

        if(count($resultadoJugador)==0){
            $hayClaveForaneaNulla = true;
            array_push($clavesForaneasFallidas,'$idJugador');
        }


        //si alguna clave foranea no ha obtenido resultados en la consulta de su modelo se lanza la excepción
        if($hayClaveForaneaNulla){
            throw new ClaveForaneaNullaException($clavesForaneasFallidas);
        }

        //recogemos los resultados del indice 0 de las consultas, en este punto ya nos hemos asegurado que tienen al menos 1 resultado

        $partidoRelacionado = $resultadoPartido[0];

        $jugadorRelacionado = $resultadoJugador[0];


        //comprobamos que el club modificador tiene permiso de modificación en dicho partido y jugador
        if( 
            $idClubModificador != (int)$jugadorRelacionado->club_id
        ||  
        ($idClubModificador != (int)$partidoRelacionado->local_id && $idClubModificador != (int)$partidoRelacionado->visitante_id))
        {
            throw new ModificacionNoAutorizadaException();
        }

        $asistenciaPartido = new Asistencia_partido();

        if($asistido !== null){
            $asistenciaPartido->asistido = $asistido;
        }
        
        if($justificado !== null){
            $asistenciaPartido->justificado = $justificado;
        }
        
        
        $partidoRelacionado->asistencia_partido()->save($asistenciaPartido);

        $jugadorRelacionado->asistencia_partido()->save($asistenciaPartido);

        $asistenciaPartido->save();

    }


    /**
     * Si existe algún registro en el array de resultados salta la excepción.
     * Es para comprobar que ho hay un registro ducplicado en el modelo según una consulta.
     */

    private static function comprobarDuplicado($resultado, string $nombreCampoDuplicado){

        if(count($resultado) > 0){
            throw new InsercionDuplicadaException($nombreCampoDuplicado);
        }

    }
    




    



    

    

}