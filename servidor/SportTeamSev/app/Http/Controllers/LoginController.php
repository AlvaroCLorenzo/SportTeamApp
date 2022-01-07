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

class LoginController extends Controller
{
    
    public function prueba(){


        try{

            /*
            GuardadoController::guardarCategoria("Primera division");
            
            GuardadoController::guardarClub("real madrid", "1234", "futbol", "2021","Primera division");

            GuardadoController::guardarClub("barsa", "1234", "futbol", "2021","Primera division");

            GuardadoController::guardarCompeticion("liga");

            GuardadoController::guardarPartido("real madrid", 'barsa', "liga" ,'2022-11-05 00:39:31');
            
            GuardadoController::guardarJugador('real madrid', 'Enrique', 'Sánchez Vicente', '+34 652359346', '2000-05-19 00:00:00');

            GuardadoController::guardarEntrenamiento(1, '2022-11-05 00:39:31', 2.5, 'campos de entrenamiento');
  
            GuardadoController::guardarAsistenciaPartidos(1,1);

            GuardadoController::guardarAsistenciaEntrenamientos(1,1);
            */


            GuardadoController::guardarJugador('barsa', 'Enrique', 'Sánchez Vicente', '+34 652359346', '2000-05-19 00:00:00');

        }catch(ClaveForaneaNullaException | FormatoParametroIncorrectoException | UsoIncorrectoSobrecargaException | InsercionDuplicadaException $ex){
            echo($ex->getMessage());
        }

        
    }


}
