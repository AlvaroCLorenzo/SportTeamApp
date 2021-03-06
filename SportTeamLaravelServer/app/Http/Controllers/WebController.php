<?php

namespace App\Http\Controllers;

use App\Exceptions\InsercionDuplicadaException;
use App\Exceptions\ModificacionNoAutorizadaException;
use App\Http\Controllers\ModelControllers\ActualizacionController;
use App\Http\Controllers\ModelControllers\ConsultaController;
use App\Http\Controllers\ModelControllers\GuardadoController;
use App\Models\Club;
use App\Models\Competicione;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Translation\MessageCatalogue;

class WebController extends Controller
{

    const ID_CLUB = '_id_clubTx_';

    public function getIndex(Request $request){


        if(session(self::ID_CLUB) != null){
            return redirect('/hub');
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

            return redirect('/hub');
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

        $club = ConsultaController::buscarClub(session(self::ID_CLUB))[0];

        
        return view('login/hub',[
            'imagen' => $club->pathImagen
        ]);
 
    }


    public function getMiClub(Request $request){

        if(session(self::ID_CLUB) == null){
            return view('unlogin/index');
        }

        $club = ConsultaController::buscarClub(session(self::ID_CLUB))[0];

        return view('login/mi-club',[
            'imagen' => $club->pathImagen,
            'club'=>$club

        ]);
    }

    public function cambiarImagen(Request $request){

        if(session(self::ID_CLUB) == null){
            return view('unlogin/index');
        }

        $club = ConsultaController::buscarClub(session(self::ID_CLUB))[0];

        $file = $request->file('avatar');

        $referencia = $file->hashName();

        $file->store(null,'public');

        ActualizacionController::actualizarPathImagenClub(session(self::ID_CLUB), $referencia);
        
        return redirect('/mi-club');
    }

    public function getJugadores(Request $request){

        if(session(self::ID_CLUB) == null){
            return view('unlogin/index');
        }

        $jugadores = ConsultaController::buscarJugador(null, session(self::ID_CLUB),null,null);

        $club = ConsultaController::buscarClub(session(self::ID_CLUB), null)[0];

        return view('login/secciones/jugadores',[
            'imagen' => $club->pathImagen,
            'jugadores' => $jugadores
        ]);

    }

    public function crearJugador(Request $request){

        if(session(self::ID_CLUB) == null){
            return view('unlogin/index');
        }

        

        if(
            isset($request->nombre)
            && 
            isset($request->apellidos)
            &&
            isset($request->fechaNacimiento)
            &&
            isset($request->telefono)
        ){

            GuardadoController::guardarJugador(
                session(self::ID_CLUB),
                $request->nombre, 
                $request->apellidos,
                $request->telefono,
                $request->fechaNacimiento.' 00:00:00');

        }

        return redirect('/jugadores');

    }

    public function getEntrenamientos(Request $request){

        if(session(self::ID_CLUB) == null){
            return view('unlogin/index');
        }

        $entrenamientos = ConsultaController::buscarEntrenamiento(null, session(self::ID_CLUB));

        $club = ConsultaController::buscarClub(session(self::ID_CLUB), null)[0];

        return view('login/secciones/entrenamientos',[
            'imagen' => $club->pathImagen,
            'entrenamientos' => $entrenamientos
        ]);

    }

    public function crearEntrenamiento(Request $request){

        if(session(self::ID_CLUB) == null){
            return view('unlogin/index');
        }

        

        if(
            isset($request->duracion)
            && 
            isset($request->lugar)
            &&
            isset($request->fecha)
            &&
            isset($request->hora)
        ){

            GuardadoController::guardarEntrenamiento(
                session(self::ID_CLUB),
                $request->fecha.' '.$request->hora,
                $request->duracion,
                $request->lugar,
                null
            );

        }

        return redirect('/entrenamientos');

    }

    public function getPartidos(Request $request){

        if(session(self::ID_CLUB) == null){
            return view('unlogin/index');
        }

        $partidos = ConsultaController::buscarPartido(null, null, null, session(self::ID_CLUB));


        $club = ConsultaController::buscarClub(session(self::ID_CLUB), null)[0];

        

        return view('login/secciones/partidos',[
            'imagen' => $club->pathImagen,
            'partidos' => $partidos,
            'competiciones' => Competicione::all(),
            'clubes' => Club::all()
        ]);

    }

    public function crearPartido(Request $request){

        if(session(self::ID_CLUB) == null){
            return view('unlogin/index');
        }

        

        if(
            isset($request->equipoLocal)
            && 
            isset($request->equipoVisitante)
            &&
            isset($request->copeticion)
            &&
            isset($request->fecha)
            &&
            isset($request->hora)
        ){

            GuardadoController::guardarPartido(
                $request->equipoLocal,
                $request->equipoVisitante,
                $request->copeticion,
                $request->fecha." ".$request->hora.":00"
            );

        }

        return redirect('/partidos');

    }

    public function getInfoPartido(Request $request){

        if(session(self::ID_CLUB) == null){
            return view('unlogin/index');
        }
        
        $club = ConsultaController::buscarClub(session(self::ID_CLUB), null)[0];

        $partido = ConsultaController::buscarPartido($request->idPartido,null,null,null)[0];

        $jugadoresClub = ConsultaController::buscarJugador(null,session(self::ID_CLUB),null,null);

        $convocatorias = ConsultaController::buscarAsistencia_partido(null, session(self::ID_CLUB), $partido->id,null);

        return view('/login/info/info-partido',[
            'imagen' => $club->pathImagen,
            'partido' => $partido,
            'jugadores' => $jugadoresClub,
            'convocatorias' => $convocatorias
        ]);

    }

    public function actObservacionPartido(Request $request){

        if(session(self::ID_CLUB) == null){
            return view('unlogin/index');
        }

        if(isset($request->observacion)){
            
            ActualizacionController::actualizarPartido(
                session(self::ID_CLUB), 
                $request->token,
                null,
                $request->observacion
            );

        }

        $request->idPartido = $request->token;
        
        return $this->getInfoPartido($request);

    }



    public function actConvocarPartidoJugador(Request $request){

        if(session(self::ID_CLUB) == null){
            return view('unlogin/index');
        }


        try{

            GuardadoController::guardarAsistenciaPartidos(
                session(self::ID_CLUB),
                $request->token,
                (int)$request->idJugador,
                null,
                null
            );

        }catch(Exception $ex){

        }

        $request->idPartido = $request->token;
        
        return $this->getInfoPartido($request);

    }


    public function actAsistenciaPartidoJugador(Request $request){

        if(session(self::ID_CLUB) == null){
            return view('unlogin/index');
        }

        $asistido = isset($request->asistido) ? true:false;
        $justificado = isset($request->justificado) ? true:false;

        try{
            
            ActualizacionController::actualizarConvocatoriaPartido(
                session(self::ID_CLUB),
                (int)$request->tokenConvocatoria,
                $asistido,
                $justificado

            );

        }catch(Exception $ex){

        }   

        $request->idPartido = $request->token;
        
        return $this->getInfoPartido($request);

    }

    public function getInfoJugador(Request $request){

        if(session(self::ID_CLUB) == null){
            return view('unlogin/index');
        }

        $club = ConsultaController::buscarClub(session(self::ID_CLUB), null)[0];
        $jugador = ConsultaController::buscarJugador($request->idJugador,null,null,null)[0];


        return view('/login/info/info-jugador',[
            'imagen' => $club->pathImagen,
            'jugador' => $jugador
        ]);

    }

    public function actObservacionJugador(Request $request){


        if(session(self::ID_CLUB) == null){
            return view('unlogin/index');
        }


        try{

            ActualizacionController::actualizarJugador(session(self::ID_CLUB), $request->token, $request->observacion);

        }catch(Exception $ex){

        }

        $club = ConsultaController::buscarClub(session(self::ID_CLUB), null)[0];
        $jugador = ConsultaController::buscarJugador($request->token,null,null,null)[0];

        $request->idJugador =  $request->token;
        
        return $this->getInfoJugador($request);

    }

    public function getInfoEntrenamiento(Request $request){

        if(session(self::ID_CLUB) == null){
            return view('unlogin/index');
        }

        $club = ConsultaController::buscarClub(session(self::ID_CLUB), null)[0];
        $entrenamiento = ConsultaController::buscarEntrenamiento($request->idEntrenamiento,null)[0];
        $jugadores = ConsultaController::buscarJugador(null, session(self::ID_CLUB),null,null);
        $convocatorias = ConsultaController::buscarAsistencia_entrenamiento(null, $entrenamiento->id,null);
        
        return view('/login/info/info-entrenamientos',[
            'imagen' => $club->pathImagen,
            'entrenamiento' => $entrenamiento,
            'jugadores' => $jugadores,
            'convocatorias' => $convocatorias
        ]);

    }

    public function actObservacionEntrenamiento(Request $request){

        if(session(self::ID_CLUB) == null){
            return view('unlogin/index');
        }

        try{

            if(isset($request->observacion)){
                ActualizacionController::actualizarEntrenamiento(session(self::ID_CLUB), $request->token, $request->observacion);
            }

        }catch(Exception $ex){

        }

        $request->idEntrenamiento =  $request->token;

        return $this->getInfoEntrenamiento($request);

    }

    public function actConvocarEntrenamiento(Request $request){
        
        try{

            GuardadoController::guardarAsistenciaEntrenamientos(
                session(self::ID_CLUB),
                $request->token,
                (int)$request->idJugador,
                null,
                null
            );

        }catch(Exception $ex){

        }

        $request->idEntrenamiento =  $request->token;

        return $this->getInfoEntrenamiento($request);

    }


    public function actAsistenciaEntrenamiento(Request $request){

        if(session(self::ID_CLUB) == null){
            return view('unlogin/index');
        }

        $asistido = isset($request->asistido) ? true:false;
        $justificado = isset($request->justificado) ? true:false;

        try{
            
            ActualizacionController::actualizarConvocatoriaEntrenamiento(
                session(self::ID_CLUB),
                (int)$request->tokenConvocatoria,
                $asistido,
                $justificado

            );

        }catch(Exception $ex){

        }

        $request->idEntrenamiento =  $request->token;

        return $this->getInfoEntrenamiento($request);
    }


    public function cambiarContra(Request $request){

        if(session(self::ID_CLUB) == null){
            return view('unlogin/index');
        }

        return view('login/cambio-contra');

    }
    

    public function actualizarContra(Request $request){

        if(session(self::ID_CLUB) == null){
            return view('unlogin/index');
        }

        if(
            isset($request->anterior)
            &&
            isset($request->nueva)
            &&
            isset($request->nueva2)
        ){

            if(strcmp($request->nueva,$request->nueva2)==0){
                
                try{
                    ActualizacionController::actualizarContra(session(self::ID_CLUB), $request->anterior, $request->nueva);
                }catch(ModificacionNoAutorizadaException $ex){
                    //si no se logra cambiar se devuelve al propio cambio de contraseña
                    return $this->cambiarContra($request);
                }

                //si se logra cambiar hay que cerrar sesion en el usuario
                //y mandarlo al index

                return $this->unLogear($request);

            }

        }

    }
    


    



    



    


}
