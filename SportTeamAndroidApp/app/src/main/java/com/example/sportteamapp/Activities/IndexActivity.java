package com.example.sportteamapp.Activities;

import androidx.appcompat.app.AppCompatActivity;
import androidx.appcompat.app.AppCompatDelegate;
import androidx.cardview.widget.CardView;

import android.content.Intent;
import android.graphics.drawable.BitmapDrawable;
import android.os.Bundle;
import android.view.Menu;
import android.view.MenuInflater;
import android.view.MenuItem;
import android.widget.TextView;
import android.widget.Toast;

import com.example.sportteamapp.Controllers.IndexActivityController;
import com.example.sportteamapp.Models.Club;
import com.example.sportteamapp.R;

public class IndexActivity extends AppCompatActivity {

    //Constantes de configuracion.
    private final String TITULO_ACTIVITY = "Sport Team";
    private final String TITULO_MI_PERFIL = "Mi Perfil";
    private final String PARTIDOS = "Partidos";
    private final String ENTRENAMIENTOS = "Entrenamientos";
    private final String JUGADORES = "Jugadores";

    //Atributos de la clase.
    private CardView cardViewPartidos, cardViewEntrenamientos, cardViewJugadores;
    private TextView textViewPartidos, textViewEntrenamientos, textViewJugadores;
    private IndexActivityController controller;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_index);

        getSupportActionBar().setDisplayShowHomeEnabled(true);
        getSupportActionBar().setTitle(this.TITULO_ACTIVITY);

        AppCompatDelegate.setDefaultNightMode(AppCompatDelegate.MODE_NIGHT_NO);

        //Inicializamos objetos
        cardViewPartidos = findViewById(R.id.carviewPartidos);
        cardViewEntrenamientos = findViewById(R.id.cardViewEntrenamientos);
        cardViewJugadores = findViewById(R.id.cardViewJugadores);

        textViewPartidos = findViewById(R.id.textViewPartidos);
        textViewEntrenamientos = findViewById(R.id.textViewEntrenamientos);
        textViewJugadores = findViewById(R.id.textViewJugadores);

        controller = new IndexActivityController(this);

        //Añadimos escuchadores.
        cardViewPartidos.setOnClickListener(controller);
        cardViewEntrenamientos.setOnClickListener(controller);
        cardViewJugadores.setOnClickListener(controller);
    }

    @Override
    public void onBackPressed() {
        super.onBackPressed();
        moveTaskToBack(true); //Para minimizar en el caso de que le de hacia atras en el index.
    }

    //Metodo al que se le pasa una cadena por parametro y lanza un toast con este contenido por pantalla.
    public void lanzarToast(String texto){
        Toast.makeText(this, texto, Toast.LENGTH_SHORT).show();
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
                //Nos desplazamos al activity de Mi Perfil
                lanzarToast(TITULO_MI_PERFIL);
                Intent intent = new Intent(IndexActivity.this, MiPerfilActivity.class);
                startActivity(intent);
                return true;
            default:
                return super.onContextItemSelected(item);
        }
    }

    //Getters de los textos para los toast.
    public String getPARTIDOS() {
        return PARTIDOS;
    }

    public String getENTRENAMIENTOS() {
        return ENTRENAMIENTOS;
    }

    public String getJUGADORES(){
        return JUGADORES;
    }
}