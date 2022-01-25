package com.example.sportteamapp.Controllers;

import android.content.Intent;
import android.view.View;

import com.example.sportteamapp.API.API;
import com.example.sportteamapp.Activities.CrearJugadorActivity;
import com.example.sportteamapp.Activities.JugadoresActivity;
import com.example.sportteamapp.Models.Club;
import com.example.sportteamapp.R;

public class CrearJugadorActivityController implements View.OnClickListener{


    //Atributos de la clase.
    private CrearJugadorActivity crearJugadorActivity;
    private String nombreJugador, apellidosJugador, fechaNacimiento, telefono;
    private API api;

    //Constructor.
    public CrearJugadorActivityController(CrearJugadorActivity crearJugadorActivity) {
        this.crearJugadorActivity = crearJugadorActivity;
    }

    @Override
    public void onClick(View v) {
        switch (v.getId()){
            case R.id.buttonCrearJugador:
                enviarActualizacion();

                crearJugadorActivity.lanzarToast(crearJugadorActivity.getJUGADOR_CREADO());
                Intent intent = new Intent(crearJugadorActivity, JugadoresActivity.class);
                intent.setFlags(Intent.FLAG_ACTIVITY_NEW_TASK | Intent.FLAG_ACTIVITY_CLEAR_TOP);
                crearJugadorActivity.startActivity(intent);
                break;
            default:
                break;
        }
    }

    //Metodo que crea un jugador mediante envio a la api.
    public void enviarActualizacion() {
        nombreJugador = crearJugadorActivity.getEditTextNombreJugador();
        apellidosJugador = crearJugadorActivity.getEditTextApellidosJugador();
        fechaNacimiento = crearJugadorActivity.getFechaNacimientoJugador();
        telefono = crearJugadorActivity.getEditTextTelefonoJugador();

        String parametros = "nombre="+ Club.getClub().getNombreClub() +"&contra="+Club.getClub().getContra();
        parametros+="&nombreJugador="+nombreJugador+"&apellidos="+apellidosJugador+"&fechaHora="+fechaNacimiento+"&telefono="+telefono;


        api = new API(API.CREAR_JUGADOR_URL, parametros);
        String respuesta = api.getRespuesta();
        if(!respuesta.equalsIgnoreCase(API.ACTUALIZACION_EXITOSA)){
            crearJugadorActivity.lanzarToast(API.ERROR_CONEXION+": Crear Jugador");
        }else if(respuesta.equals("")){
            crearJugadorActivity.lanzarToast(API.ERROR_CONEXION+"MegaErrooor 2");
        }
    }
}
