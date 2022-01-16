<?php

namespace App\Http\Controllers;

use App\Exceptions\InsercionDuplicadaException;
use App\Http\Controllers\ModelControllers\GuardadoController;
use Illuminate\Http\Request;

class WebController extends Controller
{

    const ID_CLUB = '_id_clubTx_';

    public function getIndex(Request $request){


        if(session(self::ID_CLUB) != null){
            return view('login/hub');
        }
        
        return view('unlogin/index');
    }


    public function getLogin(){
        return view('unlogin/login');
    }


    //login
    public function logear(Request $request){

        $club = LoginController::logear($request);

        if($club != null){

            //se deja puesto el id
            session([self::ID_CLUB => $club->id]);

            return view('login/hub');
        }

        return view('unlogin/login');

        
    }

    //login
    public function unLogear(Request $request){

        //eliminamos el id de la sesion
        session([self::ID_CLUB => null]);

        return view('unlogin/index');
        
    }

    //registrar un club
    public function registrarClub(Request $request){

        //se comprueban todos los datos
        if(
            !isset($request->nombreClub)
            || 
            !isset($request->contra1Club)
            ||
            !isset($request->contra2Club)
            || 
            !isset($request->temporada)
            ||
            !isset($request->deporte)
            || 
            !isset($request->categoria)
        ){
            //si no existe alguno se manda de vuelta
            return view('unlogin/registro');
        }

        //se comprueban que las dos contraseñas sean iguales
        //si no lo son
        if(strcmp($request->contra1Club, $request->contra2Club) != 0){
            return view('unlogin/registro');
        }

        //se crea el nuevo club
        try{

            //se puede guardar como club nuevo o guardar como club huerfano
            GuardadoController::guardarClub($request->nombreClub,$request->contra2Club,$request->deporte, $request->temporada, $request->categoria);
        
        //si salta la excepcion InsercionDuplicadaException es por que ya existe dicho club con mismo nombre y contraseña
        }catch(InsercionDuplicadaException $ex){

            return view('unlogin/registro');

        }
        return view('unlogin/index');

    }


    public function getHub(Request $request){

        if(session(self::ID_CLUB) == null){
            return view('unlogin/index');
        }

        return view('login/hub');
 
    }




}