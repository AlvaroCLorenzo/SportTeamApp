package com.example.sportteamapp.Activities;

import androidx.appcompat.app.AppCompatActivity;
import androidx.appcompat.app.AppCompatDelegate;

import android.graphics.drawable.Drawable;
import android.os.Bundle;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;

import com.example.sportteamapp.Controllers.ObservacionesJugadorActivityController;
import com.example.sportteamapp.Models.Jugador;
import com.example.sportteamapp.R;

public class ObservacionesJugadorActivity extends AppCompatActivity {

    //Constantes de configuracion.
    private final String TITULO_ACTIVITY = "Observaciones Jugador";
    private final String EDITAR = "EDITAR";
    private final String GUARDAR = "GUARDAR";
    private final String ALGO_FUE_MAL = "Algo fue mal...";

    //Atributos de la clase.
    private Drawable color_verde_claro;
    private Drawable color_verde_oscuro;

    private TextView textViewNombreJugador, textViewApellidosJugador, textViewFechaNacimientoJugador, textViewTelefonoJugador;
    private EditText editTextMultiLineObservacion;
    private Button buttonEditarGuardarObs;
    private ObservacionesJugadorActivityController controller;
    private Bundle bundle;
    private Jugador jugador;
    private String nombre, apellidos, fechaNacimiento, telefono, observacion;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_observaciones_jugador);

        getSupportActionBar().setDisplayHomeAsUpEnabled(false);
        getSupportActionBar().setTitle(TITULO_ACTIVITY);

        AppCompatDelegate.setDefaultNightMode(AppCompatDelegate.MODE_NIGHT_NO);

        textViewNombreJugador = findViewById(R.id.textViewNombreRealObsJugador);
        textViewApellidosJugador = findViewById(R.id.textViewApellidosRealObsJugador);
        textViewFechaNacimientoJugador = findViewById(R.id.textViewFechaNacimientoRealObsJugador);
        textViewTelefonoJugador = findViewById(R.id.textViewTelefonoRealObsJugador);
        editTextMultiLineObservacion = findViewById(R.id.editTextMultiLineObservacionJugador);
        editTextMultiLineObservacion.setFocusable(false); //Empieza sin estar en modo editar.
        buttonEditarGuardarObs = findViewById(R.id.buttonEditarGuardarObsJugador);

        color_verde_claro = getDrawable(R.drawable.shape_verde_100_layout);
        color_verde_oscuro = getDrawable(R.drawable.shape_verde_200_layout);

        controller = new ObservacionesJugadorActivityController(this);

        buttonEditarGuardarObs.setOnClickListener(controller);

        bundle = getIntent().getExtras();

        if(bundle!=null && bundle.getSerializable("Jugador")!=null){
            jugador = (Jugador) bundle.getSerializable("Jugador");
            getSupportActionBar().setTitle(jugador.getNombreCompleto());
            nombre = jugador.getNombre();
            apellidos = jugador.getApellidos();
            fechaNacimiento = jugador.getFechaNacimiento();
            telefono = jugador.getTelefono();
            observacion = jugador.getObservacion();

            textViewNombreJugador.setText(nombre);
            textViewApellidosJugador.setText(apellidos);
            textViewFechaNacimientoJugador.setText(fechaNacimiento);
            textViewTelefonoJugador.setText(telefono);
            editTextMultiLineObservacion.setText(observacion);

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
            editTextMultiLineObservacion.setBackground(color_verde_claro);
            editTextMultiLineObservacion.setFocusable(true);
            editTextMultiLineObservacion.setFocusableInTouchMode(true);
            editTextMultiLineObservacion.setClickable(true);
            //Si b=true modo no editar
        }else{
            buttonEditarGuardarObs.setText(EDITAR);
            editTextMultiLineObservacion.setBackground(color_verde_oscuro);
            editTextMultiLineObservacion.setFocusable(false);
            editTextMultiLineObservacion.setFocusableInTouchMode(false);
            editTextMultiLineObservacion.setClickable(false);

        }
    }

    //Metodo que recibe una cadena y la visualiza en forma de Toast por pantalla.
    public void lanzarToast(String texto){
        Toast.makeText(this, texto, Toast.LENGTH_SHORT).show();
    }

    public String getTextMultiLineObservacion() {
        return editTextMultiLineObservacion.getText().toString();
    }

    public String getIDJugador(){
        return this.jugador.getId();
    }
}