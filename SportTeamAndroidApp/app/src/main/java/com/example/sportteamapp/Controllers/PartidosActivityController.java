package com.example.sportteamapp.Controllers;

import android.content.Intent;
import android.view.View;
import android.widget.AdapterView;

import com.example.sportteamapp.API.API;
import com.example.sportteamapp.Activities.CrearPartidoActivity;
import com.example.sportteamapp.Activities.ObservacionesPartidoActivity;
import com.example.sportteamapp.Activities.PartidosActivity;
import com.example.sportteamapp.Models.Club;
import com.example.sportteamapp.Models.Partido;
import com.example.sportteamapp.R;

import java.util.ArrayList;

public class PartidosActivityController implements View.OnClickListener, AdapterView.OnItemClickListener {

    //Atributos de la clase
    private PartidosActivity partidosActivity;
    private API api;

    //Constructor.
    public PartidosActivityController(PartidosActivity partidosActivity) {
        this.partidosActivity = partidosActivity;
    }

    @Override
    public void onClick(View v) {
        switch (v.getId()){
            case R.id.floatingActionButtonCrearPartido:
                lanzarCrearPartido();
                break;
            default:
                break;
        }
    }

    @Override
    public void onItemClick(AdapterView<?> parent, View view, int position, long id) {
        Partido partido = partidosActivity.getPartidos().get(position);
        String equipo1 = partido.getLocal();
        String equipo2 = partido.getVisitante();
        partidosActivity.lanzarToast(equipo1+" vs "+equipo2);

        Intent intent = new Intent(partidosActivity, ObservacionesPartidoActivity.class);
        intent.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP); //Limpiara de la memoria este activity, obligando a volverlo a cargar.
        intent.putExtra("Partido", partido);
        partidosActivity.startActivity(intent);
    }

    //Metodo que lanza el activity de creacion de partido.
    private void lanzarCrearPartido() {
        partidosActivity.lanzarToast(partidosActivity.getCREAR_PARTIDO());
        Intent intent = new Intent(partidosActivity, CrearPartidoActivity.class);
        partidosActivity.startActivity(intent);
    }

    //Metodo que realiza un envio a la api y recibe los partidos del club guardados en la bbdd.
    public ArrayList<Partido> getPeticion() {
        String parametro = "nombre="+Club.getClub().getNombreClub()+"&contra="+Club.getClub().getContra();
        api = new API(API.PARTIDOS_URL, parametro);
        return api.getPartidos();
    }
}
