package com.example.sportteamapp.Controllers;

import android.view.View;

import com.example.sportteamapp.API.API;
import com.example.sportteamapp.Activities.ObservacionesJugadorActivity;
import com.example.sportteamapp.Models.Club;
import com.example.sportteamapp.R;

public class ObservacionesJugadorActivityController implements View.OnClickListener{

    //Atributos.
    private ObservacionesJugadorActivity observacionesJugadorActivity;
    private boolean editando;
    private API api;

    //Constructor.
    public ObservacionesJugadorActivityController(ObservacionesJugadorActivity observacionesJugadorActivity) {
        this.observacionesJugadorActivity = observacionesJugadorActivity;
        this.editando = false;
    }

    @Override
    public void onClick(View v) {
        switch (v.getId()){
            case R.id.buttonEditarGuardarObsJugador:
                efectoGuardarEditar();
                break;
            default:
                break;
        }
    }

    //Metodo que habilita y deshabilita la edicion del EditText Multiline segun la eleccion del usuario.
    private void efectoGuardarEditar() {
        //Si esta activado el modo editar observacion.
        if(editando){
            editando = false; //Cambiamos el flag
            observacionesJugadorActivity.cambiarAModoEditando(false); //Quitamos el modo editar

            //Si no esta activado el modo editar observacion. (modo guardar activado)
        }else{
            editando = true;
            observacionesJugadorActivity.cambiarAModoEditando(true); //Activamos el modo editar.
        }
    }

    //Metodo que actualiza las observaciones de un jugador de la bbdd mediante envio a la api.
    public void enviarActualizacion(){
        String observaciones = observacionesJugadorActivity.getTextMultiLineObservacion();
        String iD = observacionesJugadorActivity.getIDJugador();

        String parametros = "nombre="+ Club.getClub().getNombreClub() +"&contra="+Club.getClub().getContra();
        parametros+="&idJugador="+iD+"&observacion="+observaciones;

        api = new API(API.ACTUALIZAR_JUGADOR_URL, parametros);
        String respuesta = api.getRespuesta();
        if(!respuesta.equalsIgnoreCase(API.ACTUALIZACION_EXITOSA)){
            observacionesJugadorActivity.lanzarToast(API.ERROR_CONEXION+": Jugadores");
        }
    }
}
