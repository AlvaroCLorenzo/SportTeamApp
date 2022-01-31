package com.example.sportteamapp.Activities;

import androidx.appcompat.app.AppCompatActivity;
import androidx.appcompat.app.AppCompatDelegate;

import android.os.Bundle;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;

import com.example.sportteamapp.Controllers.MiPerfilActivityController;
import com.example.sportteamapp.Models.Club;
import com.example.sportteamapp.R;

public class MiPerfilActivity extends AppCompatActivity {

    //Constantes de configuracion.
    private final String TITULO_ACTIVITY = "Mi Perfil";
    private final String CERRAR_SESION = "Cerrar Sesión";

    //Atributos de la clase.
    private TextView textViewNombreClub, textViewDeporteClub, textViewTemporadaClub, textViewCategoriaClub;
    private Button buttonCerrarSesion;
    private MiPerfilActivityController controller;
    private ImageView imagenClub;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_mi_perfil);

        getSupportActionBar().setDisplayHomeAsUpEnabled(true);
        getSupportActionBar().setTitle(this.TITULO_ACTIVITY);

        AppCompatDelegate.setDefaultNightMode(AppCompatDelegate.MODE_NIGHT_NO);

        textViewNombreClub = findViewById(R.id.textViewNombreClubPerfil);
        textViewDeporteClub = findViewById(R.id.textViewDeporteClub);
        textViewTemporadaClub = findViewById(R.id.textViewTemporadaClub);
        textViewCategoriaClub = findViewById(R.id.textViewCategoriaClub);

        buttonCerrarSesion = findViewById(R.id.buttonCerrarSesion);

        controller = new MiPerfilActivityController(this);

        buttonCerrarSesion.setOnClickListener(controller);

        imagenClub = findViewById(R.id.imageViewEscudoLocal);

        setNombreClub(Club.getClub().getNombreClub());
        setDeporteClub(Club.getClub().getDeporte());
        setTemporadaClub(Club.getClub().getTemporada());
        setCategoriaClub(Club.getClub().getCategoria());

        //Setteamos la imagen decodificando en Base 64
        imagenClub.setImageBitmap(Club.getClub().getImagenBitmap());
    }

    //Metodo al que se le pasa una cadena por parametro y lanza un toast con este contenido por pantalla.
    public void lanzarToast(String texto){
        Toast.makeText(this, texto, Toast.LENGTH_SHORT).show();
    }

    //Getter texto cerrar sesion
    public String getCERRAR_SESION() {
        return CERRAR_SESION;
    }

    //Setters de los textos de los textviews de Mi Perfil
    public void setNombreClub(String nombre){
        this.textViewNombreClub.setText(nombre);
    }

    public void setDeporteClub(String deporte){
        this.textViewDeporteClub.setText(deporte);
    }

    public void setTemporadaClub(String temporada){
        this.textViewTemporadaClub.setText(temporada);
    }

    public void setCategoriaClub(String categoria){
        this.textViewCategoriaClub.setText(categoria);
    }
}