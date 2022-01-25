package com.example.sportteamapp.Activities;

import androidx.appcompat.app.AppCompatActivity;
import androidx.appcompat.app.AppCompatDelegate;

import android.os.Bundle;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Switch;
import android.widget.Toast;

import com.example.sportteamapp.Controllers.MainActivityController;
import com.example.sportteamapp.R;

public class MainActivity extends AppCompatActivity {

    //Constantes de configuración.
    private final String MENSAJE_EXITO = "Bienvenido";
    private final String MENSAJE_ERROR_LOGIN = "ERROR: club o password incorrectos";

    //Atributos de la clase.
    private EditText editTextClub, editTextPassword;
    private Button buttonLoggin;
    private Switch switchRecordar;
    private MainActivityController controller;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        //AppCompatDelegate.setDefaultNightMode(AppCompatDelegate.MODE_NIGHT_NO);

        //Inicializamos objetos.
        editTextClub = findViewById(R.id.editTextClub);
        editTextPassword = findViewById(R.id.editTextPassword);
        switchRecordar = findViewById(R.id.switchRecordar);
        buttonLoggin = findViewById(R.id.buttonLogin);
        controller = new MainActivityController(this);

        //Añadimos escuchadores.
        buttonLoggin.setOnClickListener(controller);
    }

    @Override
    protected void onResume() {
        super.onResume();
        controller.recordarDatos();
    }

    @Override
    public void onBackPressed() {
        super.onBackPressed();
        moveTaskToBack(true); //Para minimizar en el caso de que le de hacia atras en el login.
    }

    //Metodo que devuelve el estado del Switch de recordar.
    public boolean switchIsChecked(){
        if(switchRecordar.isChecked()){
            return true;
        }else{
            return false;
        }
    }

    //Metodo que deja vacios los campos de los edit Text despues de un error.
    public void vaciarCampos(){
        setEditTextClub("");
        setEditTextPassword("");
    }

    //Metodo que recibe una cadena y la muestra en forma de Toast por pantalla.
    public void lanzarToast(String texto){
        Toast.makeText(this, texto, Toast.LENGTH_SHORT).show();
    }

    //Getter y setter del Edit Text Club
    public String getEditTextClub() {
        return editTextClub.getText().toString();
    }

    public void setEditTextClub(String nombreClub) {
        this.editTextClub.setText(nombreClub);
    }

    //Getter y setter del Edit Text Password
    public String getEditTextPassword() {
        return editTextPassword.getText().toString();
    }

    public void setEditTextPassword(String password) {
        this.editTextPassword.setText(password);
    }

    public String getMENSAJE_EXITO() {
        return MENSAJE_EXITO;
    }

    public String getMENSAJE_ERROR_LOGIN() {
        return MENSAJE_ERROR_LOGIN;
    }
}