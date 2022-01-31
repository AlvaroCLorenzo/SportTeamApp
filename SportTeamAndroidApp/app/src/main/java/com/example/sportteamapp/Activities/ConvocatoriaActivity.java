package com.example.sportteamapp.Activities;

import androidx.appcompat.app.AppCompatActivity;
import androidx.appcompat.app.AppCompatDelegate;

import android.os.Bundle;
import android.widget.CheckBox;
import android.widget.ListView;
import android.widget.Toast;

import com.example.sportteamapp.Adapters.ConvocatoriaAdapter;
import com.example.sportteamapp.Controllers.ConvocatoriaActivityController;
import com.example.sportteamapp.Models.Convocado;
import com.example.sportteamapp.Models.Jugador;
import com.example.sportteamapp.R;
import com.google.android.material.floatingactionbutton.FloatingActionButton;

import java.io.Serializable;
import java.util.ArrayList;

public class ConvocatoriaActivity extends AppCompatActivity implements Serializable {

    //Constantes de configuracion.
    private final String CONVOCAR = "Convocar jugador";
    private final String TITULO_ACTIVITY = "Convocatoria";

    //Atributos de la clase.
    private ListView listViewJugadoresConvocados;
    private FloatingActionButton floatingActionButtonConvocarJugador;
    private ConvocatoriaAdapter convocatoriaAdapter;
    private ConvocatoriaActivityController controller;
    private Bundle bundle;
    private int tipo; //0=convocatoria partido, 1=convocatoria entrenamiento.
    private String idPartido, idEntrenamiento;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_convocatoria);

        getSupportActionBar().setTitle(TITULO_ACTIVITY);

        AppCompatDelegate.setDefaultNightMode(AppCompatDelegate.MODE_NIGHT_NO);

        listViewJugadoresConvocados = findViewById(R.id.listViewJugadoresConvocados);
        floatingActionButtonConvocarJugador = findViewById(R.id.floatingActionButtonConvocarJugador);

        bundle = getIntent().getExtras();
        if(bundle!=null){
            tipo = bundle.getInt("tipo");
            switch (tipo){
                case 0:
                    idPartido = bundle.getString("idPartido");
                    break;
                case 1:
                    idEntrenamiento = bundle.getString("idEntrenamiento");
                    break;
                default:
                    break;
            }
        }

        controller = new ConvocatoriaActivityController(this);
        floatingActionButtonConvocarJugador.setOnClickListener(controller);
    }

    @Override
    protected void onResume() {
        super.onResume();
        ArrayList<Convocado> jugadoresConvocados = new ArrayList<Convocado>();
        jugadoresConvocados.add(new Convocado(null, null, null, null, null));

        convocatoriaAdapter = new ConvocatoriaAdapter(this, R.layout.convocatoria_item_layout, jugadoresConvocados);
        notificarCambiosAlAdapter();
        actualizarSetJugadores(controller.getPeticion(tipo));
        notificarCambiosAlAdapter();
        listViewJugadoresConvocados.setAdapter(convocatoriaAdapter);
    }

    //Metodo que recibe una cadena y la visualiza en forma de Toast por pantalla.
    public void lanzarToast(String texto){
        Toast.makeText(this, texto, Toast.LENGTH_SHORT).show();
    }

    //getter y setter convocados
    public ArrayList<Convocado> getJugadores() {
        return convocatoriaAdapter.getJugadoresConvocados();
    }

    public void actualizarSetJugadores(ArrayList<Convocado> jugadoresConvocados){
        this.convocatoriaAdapter.setJugadores(jugadoresConvocados);
    }

    //Metodo que notifica cambios en el adapter.
    public void notificarCambiosAlAdapter(){
        this.convocatoriaAdapter.notifyDataSetChanged();
    }

    //Getter texto convocar jugador.
    public String getCONVOCAR() {
        return CONVOCAR;
    }

    //Getters
    public int getTipo() {
        return this.tipo;
    }

    public String getIdPartido() {
        return idPartido;
    }

    public String getIdEntrenamiento() {
        return idEntrenamiento;
    }

    public ConvocatoriaActivityController getController() {
        return controller;
    }

}