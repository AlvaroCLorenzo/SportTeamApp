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

            GuardadoController::guardarEntrenamiento(3, '2022-02-06 17:00:00', 2.0, 'Santiago Bernabeu');

        }catch(ClaveForaneaNullaException | FormatoParametroIncorrectoException $ex){
            echo($ex->getMessage());
        }

        
    }


}
