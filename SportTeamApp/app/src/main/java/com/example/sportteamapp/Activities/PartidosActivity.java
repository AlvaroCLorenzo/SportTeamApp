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

import com.example.sportteamapp.Adapters.PartidosAdapter;
import com.example.sportteamapp.Controllers.PartidosActivityController;
import com.example.sportteamapp.Models.Club;
import com.example.sportteamapp.Models.Partido;
import com.example.sportteamapp.R;
import com.google.android.material.floatingactionbutton.FloatingActionButton;

import java.util.ArrayList;


public class PartidosActivity extends AppCompatActivity {

    //Constantes de configuracion.
    private final String TITULO_ACTIVITY = "Partidos";
    private final String TITULO_MI_PERFIL = "Mi Perfil";
    private final String CREAR_PARTIDO = "Crear Partido";

    //Atributos de la clase.
    private FloatingActionButton botonCrearPartido;
    private PartidosActivityController controller;
    private ListView listViewPartidos;
    private PartidosAdapter partidosAdapter;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_partidos);

        getSupportActionBar().setDisplayHomeAsUpEnabled(true);
        getSupportActionBar().setTitle(TITULO_ACTIVITY);

        AppCompatDelegate.setDefaultNightMode(AppCompatDelegate.MODE_NIGHT_NO);

        botonCrearPartido = findViewById(R.id.floatingActionButtonCrearPartido);
        listViewPartidos = findViewById(R.id.listViewPartidos);

        controller = new PartidosActivityController(this);
        botonCrearPartido.setOnClickListener(controller);
        listViewPartidos.setOnItemClickListener(controller);

        ArrayList<Partido> partidos = new ArrayList<Partido>();
        partidos.add(new Partido(null,  null, null, null, null, null, null, null, null));

        partidosAdapter = new PartidosAdapter(this, R.layout.partidos_item_layout, partidos);
        listViewPartidos.setAdapter(partidosAdapter);
        this.partidosAdapter.notifyDataSetChanged();

    }

    //Para que cada vez que se meta de nuevo, como por ejemplo al volver hacia atrás, realiza una nueva peticion y refresque la lista.
    @Override
    protected void onResume() {
        super.onResume();
        actualizarSetPartidos(controller.getPeticion());
        this.partidosAdapter.notifyDataSetChanged();
    }

    public void actualizarSetPartidos(ArrayList<Partido> partidos){
        this.partidosAdapter.setPartidos(partidos);
    }

    //Lo utilizamos para inflar el elemento que vamos a añadir al menu.
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
                Intent intent = new Intent(PartidosActivity.this, MiPerfilActivity.class);
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

    //Getter texto crear partido.
    public String getCREAR_PARTIDO() {
        return CREAR_PARTIDO;
    }

    public ArrayList<Partido> getPartidos() {
        return partidosAdapter.getPartidos();
    }
}