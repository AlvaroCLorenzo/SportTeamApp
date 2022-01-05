<?php

namespace App\Http\Controllers\ModelControllers;

use App\Exceptions\ClaveForaneaNullaException;
use App\Exceptions\FormatoParametroIncorrectoException;

use App\Models\Club;
use App\Models\Categoria;
use App\Models\Competicione;
use App\Models\Entrenamiento;
use Ramsey\Uuid\Type\Decimal;

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

    public static function guardarCategoria(string $nombre){

        $categoria = new Categoria();
        $categoria->nombreCompeticion = $nombre;
        $categoria->save();

    }

    

    public static function guardarCompeticion(string $nombre){

        $categoria = new Competicione();
        $categoria->nombreCategoria = $nombre;
        $categoria->save();

    }
    


    public static function guardarClub(string $nombre, string $password, string $deporte, string $temporada, $categoria){

        //array de resultados de la consulta
        $resultado = null;
      
        //si el parametro nombreCategoria es string se busca por el campo NombreCategoria
        if(is_string($categoria)){

            $resultado = Categoria::where('nombreCategoria','=',$categoria)->get();
    
        //si es un numero entero se busca por id
        }else if(is_int($categoria)){
            
            $resultado = Categoria::where('id','=',$categoria)->get();

        }else{

            //si la categoria no es ni string ni int es que tiene un tipado incorrecto
            throw new FormatoParametroIncorrectoException(['$categoria']);

        }

        
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

        //array de resultados de la consulta
        $resultado = null;
      
        //si el parametro club es string se busca por el campo nombre de la tabla club
        if(is_string($club)){

            $resultado = Club::where('nombre','=',$club)->get();
    
        //si es un numero entero se busca por id
        }else if(is_int($club)){
            
            $resultado = Club::where('id','=',$club)->get();

        }else{

            //si el club no es ni string ni int es que tiene un tipado incorrecto
            throw new FormatoParametroIncorrectoException(['$club']);

        }

        
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

    

    

}