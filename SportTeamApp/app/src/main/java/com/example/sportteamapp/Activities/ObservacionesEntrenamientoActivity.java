package com.example.sportteamapp.Activities;

import androidx.appcompat.app.AppCompatActivity;
import androidx.appcompat.app.AppCompatDelegate;

import android.graphics.drawable.Drawable;
import android.os.Bundle;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import com.example.sportteamapp.Controllers.ObservacionesEntrenamientoActivityController;
import com.example.sportteamapp.Models.Entrenamiento;
import com.example.sportteamapp.R;

public class ObservacionesEntrenamientoActivity extends AppCompatActivity {

    //Constantes de configuracion.
    private final String TITULO_ACTIVITY = "Observaciones Entrenamiento";
    private final String EDITAR = "EDITAR";
    private final String GUARDAR = "GUARDAR";
    private final String ALGO_FUE_MAL = "Algo fue mal...";
    private final String VER_CONVOCATORIA = "Ver convocatoria";

    //Atributos de la clase.
    private Drawable color_verde_claro;
    private Drawable color_verde_oscuro;

    private Bundle bundle;
    private Entrenamiento entrenamiento;

    private EditText editTextObservacionEntrenamiento;
    private Button buttonEditarGuardarObs, buttonVerConvocatoriaEntrenamiento;
    private ObservacionesEntrenamientoActivityController controller;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_observaciones_entrenamiento);

        getSupportActionBar().setDisplayHomeAsUpEnabled(false);

        AppCompatDelegate.setDefaultNightMode(AppCompatDelegate.MODE_NIGHT_NO);

        editTextObservacionEntrenamiento = findViewById(R.id.editTextMultilineObsEntrenamiento);
        editTextObservacionEntrenamiento.setFocusable(false); //Empieza sin estar en modo editar.
        buttonEditarGuardarObs = findViewById(R.id.buttonEditarGuardarObsEntrenamiento);
        buttonVerConvocatoriaEntrenamiento = findViewById(R.id.buttonVerConvocatoriaObsEntrenamiento);

        color_verde_claro = getDrawable(R.drawable.shape_verde_100_layout);
        color_verde_oscuro = getDrawable(R.drawable.shape_verde_200_layout);

        controller = new ObservacionesEntrenamientoActivityController(this);
        buttonEditarGuardarObs.setOnClickListener(controller);
        buttonVerConvocatoriaEntrenamiento.setOnClickListener(controller);

        bundle = getIntent().getExtras();

        if(bundle!=null && bundle.getSerializable("Entrenamiento")!=null){
            entrenamiento = (Entrenamiento) bundle.getSerializable("Entrenamiento");
            getSupportActionBar().setTitle(TITULO_ACTIVITY);
            String observacion = entrenamiento.getObservacion();

            editTextObservacionEntrenamiento.setText(observacion);
        }else{
            lanzarToast(ALGO_FUE_MAL);
        }
    }

    @Override
    public void onBackPressed() {
        super.onBackPressed();
        controller.enviarActualizacion();
    }

    //Metodo que cambia la apariencia del multiline cuando se esta editando.
    public void cambiarAModoEditando(boolean b){
        //Si b=true modo editar
        if(b){
            buttonEditarGuardarObs.setText(GUARDAR);
            editTextObservacionEntrenamiento.setBackground(color_verde_claro);
            editTextObservacionEntrenamiento.setFocusable(true);
            editTextObservacionEntrenamiento.setFocusableInTouchMode(true);
            editTextObservacionEntrenamiento.setClickable(true);
            //Si b=true modo no editar
        }else{
            buttonEditarGuardarObs.setText(EDITAR);
            editTextObservacionEntrenamiento.setBackground(color_verde_oscuro);
            editTextObservacionEntrenamiento.setFocusable(false);
            editTextObservacionEntrenamiento.setFocusableInTouchMode(false);
            editTextObservacionEntrenamiento.setClickable(false);

        }
    }

    //Metodo que recibe una cadena y la visualiza en forma de Toast por pantalla.
    public void lanzarToast(String texto){
        Toast.makeText(this, texto, Toast.LENGTH_SHORT).show();
    }

    //Getter texto de la observacion del partido.
    public String getTextObservacionEntrenamiento() {
        return editTextObservacionEntrenamiento.getText().toString();
    }

    //Getter entrenamiento
    public Entrenamiento getEntrenamiento() {
        return entrenamiento;
    }

    //Getter de algo fue mal..
    public String getVER_CONVOCATORIA() {
        return VER_CONVOCATORIA;
    }
}