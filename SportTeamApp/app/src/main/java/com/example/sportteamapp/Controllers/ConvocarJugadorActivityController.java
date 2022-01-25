package com.example.sportteamapp.Controllers;

import android.view.View;
import android.widget.AdapterView;

import com.example.sportteamapp.API.API;
import com.example.sportteamapp.Activities.ConvocarJugadorActivity;
import com.example.sportteamapp.Models.Club;
import com.example.sportteamapp.Models.Jugador;

import java.util.ArrayList;

public class ConvocarJugadorActivityController implements AdapterView.OnItemClickListener {

    //Constantes de configuracion.
    private final String ERROR_CONVOCADO = "error";

    //Atributos de la clase.
    private ConvocarJugadorActivity convocarJugadorActivity;
    private API api;

    //Constructor.
    public ConvocarJugadorActivityController(ConvocarJugadorActivity convocarJugadorActivity) {
        this.convocarJugadorActivity = convocarJugadorActivity;
    }

    @Override
    public void onItemClick(AdapterView<?> parent, View view, int position, long id) {
        Jugador jugador = convocarJugadorActivity.getJugadores().get(position);
        String nombreCompleto = jugador.getNombreCompleto();
        String idJugador = jugador.getId();
        String idPartidoEntrenamiento = null;
        switch (convocarJugadorActivity.getTipo()){
            case 0:
                idPartidoEntrenamiento = convocarJugadorActivity.getIdPartido();
                break;
            case 1:
                idPartidoEntrenamiento = convocarJugadorActivity.getIdEntrenamiento();
                break;
            default:
                break;
        }
        String respuesta = getInsertarConvocatoria(idJugador, idPartidoEntrenamiento);
        if(!respuesta.equals(ERROR_CONVOCADO)){
            convocarJugadorActivity.lanzarToast(convocarJugadorActivity.CONVOCADO+nombreCompleto);
        }else{
            convocarJugadorActivity.lanzarToast(convocarJugadorActivity.ERROR+nombreCompleto);
        }

    }

    //Metodo que realiza una peticion de los jugadores del equipo mediantre envio a la api.
    public ArrayList<Jugador> getPeticion() {
        String parametro = "nombre="+ Club.getClub().getNombreClub()+"&contra="+Club.getClub().getContra();
        api = new API(API.JUGADORES_URL, parametro);
        return api.getJugadores();
    }

    //Metodo que envia una insercion de un jugador en una convocatoria de la bbdd mediantre envio a la api,
    //Recibe el id del jugador y el id del partido o de entrenamiento.
    public String getInsertarConvocatoria(String idJugador, String idPartidoEntrenamiento){
        String parametro = "nombre="+ Club.getClub().getNombreClub()+"&contra="+Club.getClub().getContra();
        parametro+="&idJugador="+idJugador;
        switch (convocarJugadorActivity.getTipo()){
            case 0:
                parametro+="&idPartido="+idPartidoEntrenamiento;
                api = new API(API.INSERTAR_CONVOCATORIA_PARTIDO_URL, parametro);
                break;
            case 1:
                parametro+="&idEntrenamiento="+idPartidoEntrenamiento;
                api = new API(API.INSERTAR_CONVOCATORIA_ENTRENAMIENTO_URL, parametro);
                break;
            default:
                break;
        }
        return api.getRespuesta();
    }
}
