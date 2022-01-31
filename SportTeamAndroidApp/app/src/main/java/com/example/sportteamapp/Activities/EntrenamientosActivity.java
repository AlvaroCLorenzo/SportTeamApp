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

import com.example.sportteamapp.Adapters.EntrenamientosAdapter;
import com.example.sportteamapp.Controllers.EntrenamientosActivityController;
import com.example.sportteamapp.Models.Club;
import com.example.sportteamapp.Models.Entrenamiento;
import com.example.sportteamapp.R;
import com.google.android.material.floatingactionbutton.FloatingActionButton;

import java.util.ArrayList;


public class EntrenamientosActivity extends AppCompatActivity {

    //Constantes de configuracion.
    private final String TITULO_ACTIVITY = "Entrenamientos";
    private final String TITULO_MI_PERFIL = "Mi Perfil";
    private final String CREAR_ENTRENAMIENTO = "Crear Entrenamiento";

    //Atributos de la clase.
    private FloatingActionButton botonCrearEntrenamiento;
    private EntrenamientosActivityController controller;
    private ListView listViewEntrenamientos;
    private EntrenamientosAdapter entrenamientosAdapter;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_entrenamientos);

        getSupportActionBar().setDisplayHomeAsUpEnabled(true);
        getSupportActionBar().setTitle(TITULO_ACTIVITY);

        AppCompatDelegate.setDefaultNightMode(AppCompatDelegate.MODE_NIGHT_NO);

        botonCrearEntrenamiento = findViewById(R.id.floatingActionButtonCrearEntrenamiento);
        listViewEntrenamientos = findViewById(R.id.listViewEntrenamientos);

        controller = new EntrenamientosActivityController(this);
        botonCrearEntrenamiento.setOnClickListener(controller);
        listViewEntrenamientos.setOnItemClickListener(controller);

        ArrayList<Entrenamiento> entrenamientos = new ArrayList<Entrenamiento>();
        entrenamientos.add(new Entrenamiento(null, null, null, null, null));

        entrenamientosAdapter = new EntrenamientosAdapter(this, R.layout.entrenamientos_item_layout, entrenamientos);
        listViewEntrenamientos.setAdapter(entrenamientosAdapter);
        entrenamientosAdapter.notifyDataSetChanged();

    }

    @Override
    protected void onResume() {
        super.onResume();
        actualizarSetEntrenamientos(controller.getPeticion());
        this.entrenamientosAdapter.notifyDataSetChanged();
    }

    public void actualizarSetEntrenamientos(ArrayList<Entrenamiento> entrenamientos){
        this.entrenamientosAdapter.setEntrenamientos(entrenamientos);
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
                Intent intent = new Intent(EntrenamientosActivity.this, MiPerfilActivity.class);
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

    //Getter texto crear entrenamiento.
    public String getCREAR_ENTRENAMIENTO() {
        return CREAR_ENTRENAMIENTO;
    }

    public ArrayList<Entrenamiento> getEntrenamientos() {
        return entrenamientosAdapter.getEntrenamientos();
    }
}