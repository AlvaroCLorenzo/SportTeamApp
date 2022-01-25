package com.example.sportteamapp.Activities;

import androidx.appcompat.app.AppCompatActivity;
import androidx.appcompat.app.AppCompatDelegate;

import android.os.Bundle;
import android.widget.Button;
import android.widget.DatePicker;
import android.widget.EditText;
import android.widget.Toast;

import com.example.sportteamapp.Controllers.CrearEntrenamientoActivityController;
import com.example.sportteamapp.R;


public class CrearEntrenamientoActivity extends AppCompatActivity {

    //Constantes de configuracion.
    private final String TITULO_ACTIVITY = "Crear Entrenamiento";
    private final String ENTRENAMIENTO_CREADO = "Entrenamiento Creado";

    //Atributos de la clase.
    private EditText editTextHora, editTextLugar, editTextDuracion;
    private DatePicker datePicker;
    private Button buttonCrearEntrenamiento;
    private CrearEntrenamientoActivityController controller;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_crear_entrenamiento);

        getSupportActionBar().setDisplayHomeAsUpEnabled(true);
        getSupportActionBar().setTitle(TITULO_ACTIVITY);

        AppCompatDelegate.setDefaultNightMode(AppCompatDelegate.MODE_NIGHT_NO);

        datePicker = findViewById(R.id.datePickerCrearEntrenamiento);
        editTextHora = findViewById(R.id.editTextHoraCrearEntrenamiento);
        editTextDuracion = findViewById(R.id.editTextDuracionCrearEntrenamiento);
        editTextLugar = findViewById(R.id.editTextLugarCrearEntrenamiento);
        buttonCrearEntrenamiento = findViewById(R.id.buttonCrearEntrenamiento);

        controller = new CrearEntrenamientoActivityController(this);

        buttonCrearEntrenamiento.setOnClickListener(controller);
    }

    //Metodo que recibe una cadena y la visualiza en forma de Toast por pantalla.
    public void lanzarToast(String texto){
        Toast.makeText(this, texto, Toast.LENGTH_SHORT).show();
    }

    //Getters
    public String getFechaCrearEntrenamiento() {
        String fecha = datePicker.getYear()+"-"+(datePicker.getMonth()+1)+"-"+datePicker.getDayOfMonth();
        return fecha;
    }

    public String getEditTextHora() {
        return editTextHora.getText().toString()+":00";
    }

    public String getEditTextLugar(){
        return editTextLugar.getText().toString();
    }

    public String getEditTextDuracion() {
        return editTextDuracion.getText().toString();
    }

    public String getENTRENAMIENTO_CREADO() {
        return ENTRENAMIENTO_CREADO;
    }
}