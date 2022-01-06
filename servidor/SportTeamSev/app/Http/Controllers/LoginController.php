<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Club;
use App\Models\Categoria;

use App\Http\Controllers\ModelControllers\GuardadoController;
use App\Exceptions\ClaveForaneaNullaException;
use App\Exceptions\FormatoParametroIncorrectoException;

class LoginController extends Controller
{
    
    public function prueba(){


        try{

            //GuardadoController::guardarCompeticion("liga");

            GuardadoController::guardarPartido("real madrid", 'barsa', "liga" ,'2022-11-05 00:39:31', '2-0' ,"todo muy bien");

            /*
            GuardadoController::guardarCategoria("Primera division");
            
            GuardadoController::guardarClub("real madrid", "1234", "futbol", "2021","Primera division");

            GuardadoController::guardarClub("barsa", "1234", "futbol", "2021","Primera division");

            */
        }catch(ClaveForaneaNullaException | FormatoParametroIncorrectoException $ex){
            echo($ex->getMessage());
        }

        
    }


}
