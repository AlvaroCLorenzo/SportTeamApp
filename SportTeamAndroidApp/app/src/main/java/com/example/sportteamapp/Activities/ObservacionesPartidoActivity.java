package com.example.sportteamapp.Activities;

import androidx.appcompat.app.AppCompatActivity;
import androidx.appcompat.app.AppCompatDelegate;

import android.graphics.drawable.Drawable;
import android.os.Bundle;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import com.example.sportteamapp.Controllers.ObservacionesPartidoActivityController;

import com.example.sportteamapp.Models.Partido;
import com.example.sportteamapp.R;


public class ObservacionesPartidoActivity extends AppCompatActivity {

    //Constantes de configuracion.
    private final String TITULO_ACTIVITY = "Observaciones Partido";
    private final String EDITAR = "EDITAR";
    private final String GUARDAR = "GUARDAR";
    private final String VER_CONVOCATORIA = "Convocatoria del Partido";
    private final String ALGO_FUE_MAL = "Algo fue mal...";

    //Atributos de la clase.
    private EditText editTextResultadoLocal, editTextResultadoVisitante, editTextObservacionPartido;
    private Button buttonEditarGuardarObs;
    private Button buttonVerConvocatoriaPartido;
    private ObservacionesPartidoActivityController controller;
    private Bundle bundle;
    private Partido partido;

    private Drawable color_verde_claro;
    private Drawable color_verde_oscuro;

    private String resultadoEquipo1, resultadoEquipo2, observacion;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_observaciones_partido);

        getSupportActionBar().setDisplayHomeAsUpEnabled(false);

        AppCompatDelegate.setDefaultNightMode(AppCompatDelegate.MODE_NIGHT_NO);

        editTextResultadoLocal = findViewById(R.id.editTextResultadoLocalObsPartido);
        editTextResultadoVisitante = findViewById(R.id.editTextResultadoVisitantelObsPartido);
        editTextObservacionPartido = findViewById(R.id.editTextMultiLineObservacionJugador);
        editTextObservacionPartido.setFocusable(false); //Empieza sin estar en modo editar.

        buttonEditarGuardarObs = findViewById(R.id.buttonEditarGuardarObsPartido);
        buttonVerConvocatoriaPartido = findViewById(R.id.buttonVerConvocatoriaPartido);

        controller = new ObservacionesPartidoActivityController(this);

        buttonEditarGuardarObs.setOnClickListener(controller);
        buttonVerConvocatoriaPartido.setOnClickListener(controller);

        color_verde_claro = getDrawable(R.drawable.shape_verde_100_layout);
        color_verde_oscuro = getDrawable(R.drawable.shape_verde_200_layout);

        bundle = getIntent().getExtras();
        if(bundle!=null && bundle.getSerializable("Partido")!=null){

            partido = (Partido) bundle.getSerializable("Partido");
            getSupportActionBar().setTitle(partido.getLocal()+" vs "+partido.getVisitante());
            resultadoEquipo1 = partido.getResultado1();
            resultadoEquipo2 = partido.getResultado2();
            observacion = partido.getObservacion();

            editTextResultadoLocal.setText(resultadoEquipo1);
            editTextResultadoVisitante.setText(resultadoEquipo2);
            editTextObservacionPartido.setText(observacion);

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
            editTextObservacionPartido.setBackground(color_verde_claro);
            editTextObservacionPartido.setFocusable(true);
            editTextObservacionPartido.setFocusableInTouchMode(true);
            editTextObservacionPartido.setClickable(true);
        //Si b=true modo no editar
        }else{
            buttonEditarGuardarObs.setText(EDITAR);
            editTextObservacionPartido.setBackground(color_verde_oscuro);
            editTextObservacionPartido.setFocusable(false);
            editTextObservacionPartido.setFocusableInTouchMode(false);
            editTextObservacionPartido.setClickable(false);

        }
    }

    //Metodo que recibe una cadena y la visualiza en forma de Toast por pantalla.
    public void lanzarToast(String texto){
        Toast.makeText(this, texto, Toast.LENGTH_SHORT).show();
    }

    //Getter texto ver convocatoria.
    public String getVER_CONVOCATORIA() {
        return VER_CONVOCATORIA;
    }

    //Getter texto de la observacion del partido.
    public String getTextObservacionPartido() {
        return editTextObservacionPartido.getText().toString();
    }

    //Getter del partido.
    public Partido getPartido() {
        return partido;
    }

    //Getters de los edit text de resultados.
    public String getEditTextResultadoLocal() {
        return editTextResultadoLocal.getText().toString();
    }

    public String getEditTextResultadoVisitante() {
        return editTextResultadoVisitante.getText().toString();
    }
}