package com.example.sportteamapp.Controllers;

import android.content.Intent;
import android.view.View;
import android.widget.AdapterView;

import com.example.sportteamapp.API.API;
import com.example.sportteamapp.Activities.CrearEntrenamientoActivity;
import com.example.sportteamapp.Activities.EntrenamientosActivity;

import com.example.sportteamapp.Activities.ObservacionesEntrenamientoActivity;
import com.example.sportteamapp.Models.Club;
import com.example.sportteamapp.Models.Entrenamiento;
import com.example.sportteamapp.R;

import java.util.ArrayList;

public class EntrenamientosActivityController implements View.OnClickListener, AdapterView.OnItemClickListener {

    //Atributos de la clase.
    private EntrenamientosActivity entrenamientosActivity;
    private API api;

    //Constructor.
    public EntrenamientosActivityController(EntrenamientosActivity entrenamientosActivity) {
        this.entrenamientosActivity = entrenamientosActivity;
    }

    @Override
    public void onClick(View v) {
        switch (v.getId()){
            case R.id.floatingActionButtonCrearEntrenamiento:
                entrenamientosActivity.lanzarToast(entrenamientosActivity.getCREAR_ENTRENAMIENTO());
                Intent intent = new Intent(entrenamientosActivity, CrearEntrenamientoActivity.class);
                entrenamientosActivity.startActivity(intent);
                break;
            default:
                break;
        }
    }

    @Override
    public void onItemClick(AdapterView<?> parent, View view, int position, long id) {
        Entrenamiento entrenamiento = entrenamientosActivity.getEntrenamientos().get(position);
        String idEntrenamiento = entrenamiento.getId();
        entrenamientosActivity.lanzarToast("Entrenamiento "+idEntrenamiento);

        Intent intent = new Intent(entrenamientosActivity, ObservacionesEntrenamientoActivity.class);
        intent.putExtra("Entrenamiento", entrenamiento);
        entrenamientosActivity.startActivity(intent);
    }

    //Metodo que pide la lista de entrenamientos del club mediante un envio a la api.
    public ArrayList<Entrenamiento> getPeticion() {
        String parametro = "nombre="+ Club.getClub().getNombreClub()+"&contra="+Club.getClub().getContra();
        api = new API(API.ENTRENAMIENTOS_URL, parametro);
        return api.getEntrenamientos();
    }
}
