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

    public const RESPUESTA_OK_LOGIN = "admitido";
    public const RESPUESTA_ERROR_LOGIN = "denegado";

    //funcion de login para dispositivos móviles
    public function logear(Request $request){

        if(self::logearApi($request) != null){
            return self::RESPUESTA_OK_LOGIN;
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
 



    public function insercion(){


        try{

            
            GuardadoController::guardarCategoria("Primera division");

            GuardadoController::guardarCategoria("Segunda division");
            
            GuardadoController::guardarClub("unionistas", "1234", "futbol", "2021","Segunda division");

            GuardadoController::guardarClub("barsa", "1234", "futbol", "2021","Primera division");

            GuardadoController::guardarClub("real madrid", "1234", "futbol", "2021","Primera division");

            GuardadoController::guardarCompeticion("liga 2ªB");

            GuardadoController::guardarPartido("real madrid", 'unionistas', "liga 2ªB" ,'2022-11-05 00:39:31');
            
            GuardadoController::guardarJugador('real madrid', 'Alvaro', 'Cañada Lorenzo', '+34 652359346', '2000-05-19 00:00:00');

            GuardadoController::guardarJugador('real madrid', 'Pedro', 'Lopez Lorenzo', '+34 652359346', '2000-05-19 00:00:00');

            GuardadoController::guardarJugador('real madrid', 'Francisco', 'Jaima Álvarez', '+34 652359346', '2000-05-19 00:00:00');

            GuardadoController::guardarJugador('real madrid', 'José', 'Turrion Cervera', '+34 652359346', '2000-05-19 00:00:00');

            GuardadoController::guardarJugador('real madrid', 'Willy', 'Rex Sánchez', '+34 652359346', '2000-05-19 00:00:00');

            

            GuardadoController::guardarEntrenamiento(1, '2022-11-05 00:39:31', 2.5, 'campos de entrenamiento');
  
            GuardadoController::guardarAsistenciaPartidos(1,1);

            GuardadoController::guardarAsistenciaEntrenamientos(1,1);
            
            GuardadoController::guardarJugador('barsa', 'Enrique', 'Sánchez Vicente', '+34 652359346', '2000-05-19 00:00:00');


            GuardadoController::guardarPartido(2,1,null,'2023-01-09 02:26:49',null,null);
            GuardadoController::guardarPartido(1,2,null,'2021-11-30 02:26:49',null,null);
            GuardadoController::guardarPartido(2,1,null,'2022-02-10 02:26:49',null,null);
            GuardadoController::guardarPartido(2,1,null,'2022-02-20 02:26:49',null,null);
            GuardadoController::guardarPartido(2,1,null,'2022-09-01 02:26:49',null,null);
            GuardadoController::guardarPartido(1,2,null,'2023-11-30 02:26:49',null,null);
            
        }catch(ClaveForaneaNullaException | FormatoParametroIncorrectoException | UsoIncorrectoSobrecargaException | InsercionDuplicadaException $ex){
            echo($ex->getMessage());
        }


        
    }


}
