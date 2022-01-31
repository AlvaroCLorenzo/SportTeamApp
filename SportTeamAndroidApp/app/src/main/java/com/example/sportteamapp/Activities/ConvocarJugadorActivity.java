package com.example.sportteamapp.Activities;

import androidx.appcompat.app.AppCompatActivity;
import androidx.appcompat.app.AppCompatDelegate;

import android.content.Intent;
import android.os.Bundle;
import android.widget.ListView;
import android.widget.Toast;

import com.example.sportteamapp.Adapters.JugadoresAdapter;
import com.example.sportteamapp.Controllers.ConvocarJugadorActivityController;
import com.example.sportteamapp.Models.Jugador;
import com.example.sportteamapp.R;

import java.util.ArrayList;

public class ConvocarJugadorActivity extends AppCompatActivity {



    //Constantes de configuracion.
    private final String TITULO_ACTIVITY = "Convocar Jugador";
    public static final String CONVOCADO = "Convocado: ";
    public static final String ERROR = "Este jugador ya está convocado: ";

    //Atributos de la clase.
    private ListView listViewJugadores;
    private ConvocarJugadorActivityController controller;
    private JugadoresAdapter jugadoresAdapter;
    private Bundle bundle;
    private int tipo;
    private String idPartido, idEntrenamiento;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_convocar_jugador);

        getSupportActionBar().setTitle(TITULO_ACTIVITY);

        AppCompatDelegate.setDefaultNightMode(AppCompatDelegate.MODE_NIGHT_NO);

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

        listViewJugadores = findViewById(R.id.listViewConvocarJugador);

        controller = new ConvocarJugadorActivityController(this);

        listViewJugadores.setOnItemClickListener(controller);

        ArrayList<Jugador> jugadoresAConvocar = new ArrayList<Jugador>();
        jugadoresAConvocar.add(new Jugador(null, null, null, null, null, null));

        jugadoresAdapter = new JugadoresAdapter(this, R.layout.convocar_jugador_layout, jugadoresAConvocar);
        listViewJugadores.setAdapter(jugadoresAdapter);

    }

    @Override
    public void onBackPressed(){
        Intent intent = new Intent(ConvocarJugadorActivity.this, ConvocatoriaActivity.class);
        intent.setFlags(Intent.FLAG_ACTIVITY_NEW_TASK | Intent.FLAG_ACTIVITY_CLEAR_TOP);
        intent.putExtra("tipo", getTipo());
        intent.putExtra("idPartido", getIdPartido());
        intent.putExtra("idEntrenamiento", getIdEntrenamiento());
        this.startActivity(intent);
    }

    @Override
    protected void onResume() {
        super.onResume();
        actualizarSetJugadores(controller.getPeticion());
        this.jugadoresAdapter.notifyDataSetChanged();
    }

    public void actualizarSetJugadores(ArrayList<Jugador> jugadores){
        this.jugadoresAdapter.setJugadores(jugadores);
    }

    //Metodo que recibe una cadena y la visualiza en forma de Toast por pantalla.
    public void lanzarToast(String texto){
        Toast.makeText(this, texto, Toast.LENGTH_SHORT).show();
    }

    public ArrayList<Jugador> getJugadores() {
        return jugadoresAdapter.getJugadores();
    }

    public int getTipo() {
        return tipo;
    }

    public String getIdPartido() {
        return idPartido;
    }

    public String getIdEntrenamiento() {
        return idEntrenamiento;
    }
}