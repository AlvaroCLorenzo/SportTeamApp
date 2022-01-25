package com.example.sportteamapp.Controllers;

import android.content.Intent;
import android.view.View;
import android.widget.CheckBox;

import androidx.constraintlayout.widget.ConstraintLayout;

import com.example.sportteamapp.API.API;
import com.example.sportteamapp.Activities.ConvocarJugadorActivity;
import com.example.sportteamapp.Activities.ConvocatoriaActivity;
import com.example.sportteamapp.Models.Club;
import com.example.sportteamapp.Models.Convocado;
import com.example.sportteamapp.Models.ViewHolderConvocatoria;
import com.example.sportteamapp.R;

import java.util.ArrayList;

public class ConvocatoriaActivityController implements View.OnClickListener {

    //Atributos de la clase.
    private ConvocatoriaActivity convocatoriaActivity;
    private API api;
    private ViewHolderConvocatoria holder;
    private int tipo;

    //Constructor.
    public ConvocatoriaActivityController(ConvocatoriaActivity convocatoriaActivity) {
        this.convocatoriaActivity = convocatoriaActivity;

    }

    @Override
    public void onClick(View v) {
        switch (v.getId()){
            case R.id.floatingActionButtonConvocarJugador:
                convocatoriaActivity.lanzarToast(convocatoriaActivity.getCONVOCAR());
                Intent intent  = new Intent(convocatoriaActivity, ConvocarJugadorActivity.class);
                intent.putExtra("tipo", convocatoriaActivity.getTipo());
                intent.putExtra("idPartido", convocatoriaActivity.getIdPartido());
                intent.putExtra("idEntrenamiento", convocatoriaActivity.getIdEntrenamiento());
                convocatoriaActivity.startActivity(intent);
                break;
            case R.id.checkBoxAsistido:
                holder = (ViewHolderConvocatoria) ((ConstraintLayout)v.getParent().getParent().getParent()).getTag();
                String idConvocatoriaPartido = convocatoriaActivity.getJugadores().get(holder.posicion).getId();
                String asistido = ((CheckBox)v).isChecked() ? "true" : "false";
                getActualizacionAsistido(idConvocatoriaPartido, asistido);

                break;
            case R.id.checkBoxJustificado:
                holder = (ViewHolderConvocatoria) ((ConstraintLayout)v.getParent().getParent().getParent()).getTag();
                String idConvocatoriaEntrenamiento = convocatoriaActivity.getJugadores().get(holder.posicion).getId();
                String justificado = ((CheckBox)v).isChecked() ? "true" : "false";
                getActualizacionJustificado(idConvocatoriaEntrenamiento, justificado);
                break;
            default:
                break;
        }
    }

    //Metodo que actualiza la asistencia a una convocatoria de un jugador mediante envio a la api.
    public void getActualizacionAsistido(String id, String asistido){
        String parametro = "nombre="+ Club.getClub().getNombreClub()+"&contra="+Club.getClub().getContra();
        parametro+="&idConvocatoria="+id+"&asistido="+asistido;
        switch (tipo){
            case 0:
                api = new API(API.ACTUALIZAR_CONVOCATORIA_PARTIDO_URL, parametro);
                break;
            case 1:
                api = new API(API.ACTUALIZAR_CONVOCATORIA_ENTRENAMIENTO_URL, parametro);
                break;
            default:
                break;
        }
    }

    //Metodo que actualiza la justificacion a una convocatoria de un jugador mediante envio a la api.
    public void getActualizacionJustificado(String id, String justificado){
        String parametro = "nombre="+ Club.getClub().getNombreClub()+"&contra="+Club.getClub().getContra();
        parametro+="&idConvocatoria="+id+"&justificado="+justificado;
        switch (tipo){
            case 0:
                api = new API(API.ACTUALIZAR_CONVOCATORIA_PARTIDO_URL, parametro);
                break;
            case 1:
                api = new API(API.ACTUALIZAR_CONVOCATORIA_ENTRENAMIENTO_URL, parametro);
                break;
            default:
                break;
        }
    }

    //Metodo que realiza una peticion de los jugadores de la convocatoria mediantre envio a la api.
    public ArrayList<Convocado> getPeticion(int tipo) {
        this.tipo = tipo;
        String parametro = "nombre="+ Club.getClub().getNombreClub()+"&contra="+Club.getClub().getContra();
        switch (tipo){
            case 0:
                parametro+="&idPartido="+convocatoriaActivity.getIdPartido();
                api = new API(API.CONVOCATORIA_PARTIDO_URL, parametro);
                break;
            case 1:
                parametro+="&idEntrenamiento="+convocatoriaActivity.getIdEntrenamiento();
                api = new API(API.CONVOCATORIA_ENTRENAMIENTO_URL, parametro);
                break;
            default:
                break;
        }
        return api.getConvocados();
    }
}