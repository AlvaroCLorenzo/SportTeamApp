package com.example.sportteamapp.Activities;

import androidx.appcompat.app.AppCompatActivity;
import androidx.appcompat.app.AppCompatDelegate;

import android.os.Bundle;
import android.widget.Button;
import android.widget.DatePicker;
import android.widget.EditText;
import android.widget.Toast;

import com.example.sportteamapp.Controllers.CrearJugadorActivityController;
import com.example.sportteamapp.R;

public class CrearJugadorActivity extends AppCompatActivity {

    //Constantes de configuracion.
    private final String TITULO_ACTIVITY = "Crear Jugador";
    private final String JUGADOR_CREADO = "Jugador Creado";

    //Atributos de la clase.
    private EditText editTextNombreJugador, editTextApellidosJugador, editTextTelefonoJugador;
    private Button buttonCrearJugador;
    private DatePicker datePickerFechaNacimientoJugador;
    private CrearJugadorActivityController controller;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_crear_jugador);

        getSupportActionBar().setDisplayHomeAsUpEnabled(true);
        getSupportActionBar().setTitle(TITULO_ACTIVITY);

        AppCompatDelegate.setDefaultNightMode(AppCompatDelegate.MODE_NIGHT_NO);

        editTextNombreJugador = findViewById(R.id.editTextNombreCrearJugador);
        editTextApellidosJugador = findViewById(R.id.editTextApellidosCrearJugador);
        datePickerFechaNacimientoJugador = findViewById(R.id.datePickerCrearJugador);
        editTextTelefonoJugador = findViewById(R.id.editTextTelefonoCrearJugador);
        buttonCrearJugador = findViewById(R.id.buttonCrearJugador);

        controller = new CrearJugadorActivityController(this);

        buttonCrearJugador.setOnClickListener(controller);
    }

    //Metodo que recibe una cadena y la visualiza en forma de Toast por pantalla.
    public void lanzarToast(String texto){
        Toast.makeText(this, texto, Toast.LENGTH_SHORT).show();
    }

    //Getter texto entrenamiento creado.
    public String getJUGADOR_CREADO() {
        return JUGADOR_CREADO;
    }

    //Getters
    public String getEditTextNombreJugador() {
        return editTextNombreJugador.getText().toString();
    }

    public String getEditTextApellidosJugador() {
        return editTextApellidosJugador.getText().toString();
    }

    public String getFechaNacimientoJugador() {
        //Formato de envio para laravel
        String fecha = datePickerFechaNacimientoJugador.getYear()+"-"+(datePickerFechaNacimientoJugador.getMonth()+1)+"-"+datePickerFechaNacimientoJugador.getDayOfMonth()+" 00:00:00";
        return fecha;
    }

    public String getEditTextTelefonoJugador() {
        return editTextTelefonoJugador.getText().toString();
    }
}