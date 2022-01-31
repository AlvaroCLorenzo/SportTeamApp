package com.example.sportteamapp.Controllers;

import android.content.Intent;
import android.view.View;

import com.example.sportteamapp.API.API;
import com.example.sportteamapp.Activities.EntrenamientosActivity;
import com.example.sportteamapp.Activities.IndexActivity;
import com.example.sportteamapp.Activities.JugadoresActivity;
import com.example.sportteamapp.Activities.PartidosActivity;
import com.example.sportteamapp.Models.Club;
import com.example.sportteamapp.R;

import java.util.ArrayList;

public class IndexActivityController implements View.OnClickListener {

    private IndexActivity indexActivity;
    private Intent intent;
    private API api;
    private String parametro;

    public IndexActivityController(IndexActivity indexActivity){
        this.indexActivity = indexActivity;
        this.parametro ="nombre="+ Club.getClub().getNombreClub() +"&contra="+Club.getClub().getContra();
    }

    @Override
    public void onClick(View v) {
        switch (v.getId()){
            case R.id.carviewPartidos:
                indexActivity.lanzarToast(indexActivity.getPARTIDOS());
                intent = new Intent(indexActivity, PartidosActivity.class);
                break;
            case R.id.cardViewEntrenamientos:
                indexActivity.lanzarToast(indexActivity.getENTRENAMIENTOS());
                intent = new Intent(indexActivity, EntrenamientosActivity.class);
                break;
            case R.id.cardViewJugadores:
                indexActivity.lanzarToast(indexActivity.getJUGADORES());
                intent = new Intent(indexActivity, JugadoresActivity.class);
                break;
            default:
                break;
        }
        indexActivity.startActivity(intent);
    }

}
