<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Club;
use App\Models\Categoria;

use App\Http\Controllers\ModelControllers\GuardadoController;
use App\Exceptions\ClaveForaneaNullaException;
use App\Exceptions\FormatoParametroIncorrectoException;
use App\Exceptions\InsercionDuplicadaException;
use App\Exceptions\UsoIncorrectoSobrecargaException;
use App\Http\Controllers\ModelControllers\ConsultaController;

class LoginController extends Controller
{

    /**
     * Se espera el nombre del usuario y la password encriptada con SHA256.
    */

    public const RESPUESTA_ERROR_LOGIN = "denegado";

    //funcion de login para dispositivos móviles
    public function logear(Request $request){

        $validacion = self::logearApi($request);

        if($validacion != null){
            
            return ConsultaController::buscarClub($validacion)[0];

        }else{
            return self::RESPUESTA_ERROR_LOGIN;
        }

    }

    /**
     * Funcion estándar para validar al usuario en cada peticion.
     * Si el loggin es incorrecto returna null.
     * Si el loggin es correcto retorna el id del Club que se ha validado.
     * 
     */
    public static function logearApi(Request $request){

        $retorno = null;
        
        //si existen en el request el nombre y la contraseña
        if(isset($request->nombre) && isset($request->contra)){
           
            //se busca
            $respuesta = ConsultaController::buscarClub($request->nombre);

            //se mira que el numero de registros de la respuesta es por lo menos 1.
            if(count($respuesta)>0){

                //se compara la contraseña
                if(strcmp($request->contra, $respuesta[0]->password) == 0){
                    $retorno = (int)$respuesta[0]->id;
                }
            }
        }
        
        return $retorno;
        
    }
 

    public static function alta(Request $request){

        GuardadoController::guardarClub($request->nombre, $request->contra, "futbol", "2021","Segunda division");
    }


    public function insercion(){


        try{

            

            GuardadoController::guardarCategoria("Primera division");

            GuardadoController::guardarCategoria("Segunda division");
            
            GuardadoController::guardarClub("unionistas", "1234", "futbol", "2021-2022",null);

            GuardadoController::guardarClub("barsa", "1234", "futbol", "2021-2022","Primera division");

            GuardadoController::guardarClub("real madrid", "1234", "futbol", "2021-2022","Primera division");

            GuardadoController::guardarCompeticion("liga santander");

            GuardadoController::guardarCompeticion("champions");

            GuardadoController::guardarPartido("real madrid", 'unionistas', "liga santander" ,'2022-11-05 00:39:31');



        }catch(ClaveForaneaNullaException | FormatoParametroIncorrectoException | UsoIncorrectoSobrecargaException | InsercionDuplicadaException $ex){
            echo($ex->getMessage());
        }


        
    }


}
