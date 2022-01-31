package com.example.sportteamapp.Activities;

import androidx.appcompat.app.AppCompatActivity;
import androidx.appcompat.app.AppCompatDelegate;
import androidx.cardview.widget.CardView;
import androidx.constraintlayout.widget.ConstraintLayout;

import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.DatePicker;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;

import com.example.sportteamapp.Controllers.CrearPartidosActivityController;
import com.example.sportteamapp.R;

public class CrearPartidoActivity extends AppCompatActivity {

    private final String TITULO_ACTIVITY = "Crear Partido";
    private final String PARTIDO_CREADO = "Partido Creado";
    private final String ERROR_NOMBRE_EQUIPOS = "Error al introducir los equipos.\nComprueba que has escrito bien los campos,\n" +
            "o que perteneces a algun equipo del partido.";

    //Atributos de la clase.
    private ConstraintLayout constraintLayoutFondo;
    private TextView textViewEquipoLocal, textViewEquipoVisitante, textViewFecha, textViewHora;
    private EditText editTextEquipoLocal, editTextEquipoVisitante, editTextHora, editTextCompeticion;
    private DatePicker datePicker;
    private Button botonCrearPartido, botonConfirmarCrearPartido;
    private CardView cardViewCrearPartido, cardViewConfirmarCrearPartido;
    private CrearPartidosActivityController controller;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_crear_partido);

        getSupportActionBar().setDisplayHomeAsUpEnabled(true);
        getSupportActionBar().setTitle(TITULO_ACTIVITY);

        AppCompatDelegate.setDefaultNightMode(AppCompatDelegate.MODE_NIGHT_NO);

        constraintLayoutFondo = findViewById(R.id.constraintLayoutFondoCrearPartido);

        textViewEquipoLocal = findViewById(R.id.textViewEquipoLocal);
        textViewEquipoVisitante = findViewById(R.id.textViewEquipoVisitante);
        textViewFecha = findViewById(R.id.textViewFechaCrearPartido);
        textViewHora = findViewById(R.id.textViewHoraCrearPartido);


        editTextEquipoLocal = findViewById(R.id.editTextEquipoLocal);
        editTextEquipoVisitante = findViewById(R.id.editTextEquipoVisitante);
        editTextHora = findViewById(R.id.editTextHoraCrearPartido);
        editTextCompeticion = findViewById(R.id.editTextCompeticionCrearPartido);
        datePicker = findViewById(R.id.datePickerCrearPartido);
        botonCrearPartido = findViewById(R.id.buttonCrearPartido);
        botonConfirmarCrearPartido = findViewById(R.id.buttonConfirmarCrearPartido);
        cardViewCrearPartido = findViewById(R.id.cardViewCrearPartido);
        cardViewConfirmarCrearPartido = findViewById(R.id.cardViewCompeticion);

        controller = new CrearPartidosActivityController(this);

        constraintLayoutFondo.setOnClickListener(controller);
        botonCrearPartido.setOnClickListener(controller);
        botonConfirmarCrearPartido.setOnClickListener(controller);

        deshabilitarCardViewConfirmar(true); //Ocultamos el cardview de confirmacion cuando se lanza la vista.

    }

    //Metodo que recibe una cadena y la visualiza en forma de Toast por pantalla.
    public void lanzarToast(String texto){
        Toast.makeText(this, texto, Toast.LENGTH_SHORT).show();
    }

    //Getter texto partido creado.
    public String getPARTIDO_CREADO() {
        return PARTIDO_CREADO;
    }

    //Getter texto error al crear partido.
    public String getERROR_NOMBRE_EQUIPOS() {
        return ERROR_NOMBRE_EQUIPOS;
    }

    //Metodo que habilita y deshabilita el cardview de confirmacion.
    public void deshabilitarCardViewConfirmar(boolean b){
        //Si b=true se bloquea.
        if(b){
            cardViewConfirmarCrearPartido.setEnabled(false);
            cardViewConfirmarCrearPartido.setVisibility(View.INVISIBLE);
        //Si b=false se desbloquea.
        }else{
            cardViewConfirmarCrearPartido.setEnabled(true);
            cardViewConfirmarCrearPartido.setVisibility(View.VISIBLE);
        }
    }

    //Metodo que habilita y deshabilita el cardview de crear partido.
    public void deshabilitarCardViewCrearPartido(boolean b){
        //Si b=true se bloquea.
        if(b){
            textViewEquipoLocal.setVisibility(View.INVISIBLE);
            textViewEquipoVisitante.setVisibility(View.INVISIBLE);
            textViewFecha.setVisibility(View.INVISIBLE);
            textViewHora.setVisibility(View.INVISIBLE);

            cardViewCrearPartido.setVisibility(View.INVISIBLE);
            cardViewCrearPartido.setEnabled(false);

            editTextEquipoLocal.setVisibility(View.INVISIBLE);
            editTextEquipoLocal.setEnabled(false);

            editTextEquipoVisitante.setVisibility(View.INVISIBLE);
            editTextEquipoVisitante.setEnabled(false);

            datePicker.setVisibility(View.INVISIBLE);
            datePicker.setEnabled(false);
            datePicker.setClickable(false);

            editTextHora.setVisibility(View.INVISIBLE);
            editTextHora.setEnabled(false);

            botonCrearPartido.setVisibility(View.INVISIBLE);
            botonCrearPartido.setEnabled(false);

        //Si b=false se desbloquea.
        }else{
            textViewEquipoLocal.setVisibility(View.VISIBLE);
            textViewEquipoVisitante.setVisibility(View.VISIBLE);
            textViewFecha.setVisibility(View.VISIBLE);
            textViewHora.setVisibility(View.VISIBLE);

            cardViewCrearPartido.setVisibility(View.VISIBLE);
            cardViewCrearPartido.setEnabled(true);

            editTextEquipoLocal.setVisibility(View.VISIBLE);
            editTextEquipoLocal.setEnabled(true);

            editTextEquipoVisitante.setVisibility(View.VISIBLE);
            editTextEquipoVisitante.setEnabled(true);

            datePicker.setVisibility(View.VISIBLE);
            datePicker.setClickable(true);
            datePicker.setEnabled(true);

            editTextHora.setVisibility(View.VISIBLE);
            editTextHora.setEnabled(true);

            botonCrearPartido.setVisibility(View.VISIBLE);
            botonCrearPartido.setEnabled(true);
        }
    }

    //Getters
    public String getEditTextEquipoLocal() {
        return editTextEquipoLocal.getText().toString();
    }

    public String getEditTextEquipoVisitante() {
        return editTextEquipoVisitante.getText().toString();
    }

    public String getEditTextHora() {
        return editTextHora.getText().toString()+":00";
    }

    public String getEditTextCompeticion() {
        return editTextCompeticion.getText().toString();
    }

    public String getFechaCrearPartido() {
        String fecha = datePicker.getYear()+"-"+(datePicker.getMonth()+1)+"-"+datePicker.getDayOfMonth();
        return fecha;
    }
}