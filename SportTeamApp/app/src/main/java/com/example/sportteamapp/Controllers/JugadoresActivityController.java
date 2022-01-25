package com.example.sportteamapp.Controllers;

import android.content.Intent;
import android.view.View;
import android.widget.AdapterView;

import com.example.sportteamapp.API.API;
import com.example.sportteamapp.Activities.CrearJugadorActivity;
import com.example.sportteamapp.Activities.JugadoresActivity;
import com.example.sportteamapp.Activities.ObservacionesJugadorActivity;
import com.example.sportteamapp.Models.Club;
import com.example.sportteamapp.Models.Jugador;
import com.example.sportteamapp.R;

import java.util.ArrayList;

public class JugadoresActivityController implements View.OnClickListener, AdapterView.OnItemClickListener {

    //Atributos de la clase.
    private JugadoresActivity jugadoresActivity;
    private API api;

    //Constructor.
    public JugadoresActivityController(JugadoresActivity jugadoresActivity) {
        this.jugadoresActivity = jugadoresActivity;
    }

    @Override
    public void onClick(View v) {
        switch (v.getId()){
            case R.id.floatingActionButtonCrearJugador:
                jugadoresActivity.lanzarToast(jugadoresActivity.getCREAR_JUGADOR());
                Intent intent = new Intent(jugadoresActivity, CrearJugadorActivity.class);
                jugadoresActivity.startActivity(intent);
                break;
            default:
                break;
        }
    }

    @Override
    public void onItemClick(AdapterView<?> parent, View view, int position, long id) {
        Jugador jugador = jugadoresActivity.getJugadores().get(position);
        String nombreCompleto = jugador.getNombreCompleto();
        jugadoresActivity.lanzarToast(nombreCompleto);

        Intent intent = new Intent(jugadoresActivity, ObservacionesJugadorActivity.class);
        intent.putExtra("Jugador", jugador);
        jugadoresActivity.startActivity(intent);
    }

    //Metodo que pide la lista de jugadores del club mediante un envio a la api.
    public ArrayList<Jugador> getPeticion() {
        String parametro = "nombre="+ Club.getClub().getNombreClub()+"&contra="+Club.getClub().getContra();
        api = new API(API.JUGADORES_URL, parametro);
        return api.getJugadores();
    }
}
