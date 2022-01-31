package com.example.sportteamapp.Activities;

import androidx.appcompat.app.AppCompatActivity;
import androidx.appcompat.app.AppCompatDelegate;

import android.content.Intent;
import android.graphics.drawable.BitmapDrawable;
import android.os.Bundle;
import android.view.Menu;
import android.view.MenuInflater;
import android.view.MenuItem;
import android.widget.ListView;
import android.widget.Toast;

import com.example.sportteamapp.Adapters.JugadoresAdapter;
import com.example.sportteamapp.Controllers.JugadoresActivityController;
import com.example.sportteamapp.Models.Club;
import com.example.sportteamapp.Models.Jugador;
import com.example.sportteamapp.R;
import com.google.android.material.floatingactionbutton.FloatingActionButton;

import java.util.ArrayList;

public class JugadoresActivity extends AppCompatActivity {

    //Constantes de configuracion.
    private final String TITULO_ACTIVITY = "Jugadores";
    private final String TITULO_MI_PERFIL = "Mi Perfil";
    private final String CREAR_JUGADOR = "Crear Jugador";

    //Atributos de la clase.
    private FloatingActionButton botonCrearJugador;
    private JugadoresActivityController controller;
    private ListView listViewJugadores;
    private JugadoresAdapter jugadoresAdapter;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_jugadores);

        getSupportActionBar().setDisplayHomeAsUpEnabled(true);
        getSupportActionBar().setTitle(TITULO_ACTIVITY);

        AppCompatDelegate.setDefaultNightMode(AppCompatDelegate.MODE_NIGHT_NO);

        listViewJugadores = findViewById(R.id.listViewJugadoresClub);
        botonCrearJugador = findViewById(R.id.floatingActionButtonCrearJugador);

        controller = new JugadoresActivityController(this);
        botonCrearJugador.setOnClickListener(controller);
        listViewJugadores.setOnItemClickListener(controller);

        ArrayList<Jugador> jugadores = new ArrayList<Jugador>();
        jugadores.add(new Jugador(null, null, null, null, null, null));

        jugadoresAdapter = new JugadoresAdapter(this, R.layout.jugadores_item_layout, jugadores);
        listViewJugadores.setAdapter(jugadoresAdapter);

        jugadoresAdapter.notifyDataSetChanged();
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

    //Lo utilizamos para inflar el elemento que vamos a añadir al menu
    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        MenuInflater menuInflater = getMenuInflater();
        menuInflater.inflate(R.menu.menu_idex,menu);
        MenuItem item = menu.getItem(0);
        item.setIcon(new BitmapDrawable(Club.getImagenBitmap()));
        return true;
    }


    //Lo utilizamos para dar una utilizad al item del menu.
    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        switch (item.getItemId()){
            case R.id.itemMiPerfil:
                lanzarToast(TITULO_MI_PERFIL);
                //Nos desplazamos al activity de Mi Perfil
                Intent intent = new Intent(JugadoresActivity.this, MiPerfilActivity.class);
                startActivity(intent);
                return true;
            default:
                return super.onContextItemSelected(item);
        }
    }

    //Metodo que recibe una cadena y la visualiza en forma de Toast por pantalla.
    public void lanzarToast(String texto){
        Toast.makeText(this, texto, Toast.LENGTH_SHORT).show();
    }

    //Getter texto crear jugador.
    public String getCREAR_JUGADOR() {
        return CREAR_JUGADOR;
    }

    public ArrayList<Jugador> getJugadores() {
        return jugadoresAdapter.getJugadores();
    }
}