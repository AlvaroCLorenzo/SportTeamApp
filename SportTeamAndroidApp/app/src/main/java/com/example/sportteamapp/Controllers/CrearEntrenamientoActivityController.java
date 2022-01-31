package com.example.sportteamapp.Controllers;

import android.content.Intent;
import android.view.View;

import com.example.sportteamapp.API.API;
import com.example.sportteamapp.Activities.CrearEntrenamientoActivity;
import com.example.sportteamapp.Activities.EntrenamientosActivity;
import com.example.sportteamapp.Models.Club;
import com.example.sportteamapp.R;

public class CrearEntrenamientoActivityController implements View.OnClickListener{

    //Atributos de la clase.
    private CrearEntrenamientoActivity crearEntrenamientoActivity;
    private String fecha, hora, lugar, duracion, fechaHora;
    private API api;

    //Constructor.
    public CrearEntrenamientoActivityController(CrearEntrenamientoActivity crearEntrenamientoActivity) {
        this.crearEntrenamientoActivity = crearEntrenamientoActivity;
    }

    @Override
    public void onClick(View v) {
        switch (v.getId()) {
            case R.id.buttonCrearEntrenamiento:
                enviarActualizacion();

                crearEntrenamientoActivity.lanzarToast(crearEntrenamientoActivity.getENTRENAMIENTO_CREADO());
                Intent intent = new Intent(crearEntrenamientoActivity, EntrenamientosActivity.class);
                intent.setFlags(Intent.FLAG_ACTIVITY_NEW_TASK | Intent.FLAG_ACTIVITY_CLEAR_TOP);
                crearEntrenamientoActivity.startActivity(intent);
                break;
            default:
                break;
        }
    }

    //Metodo que crea un entrenamiento en la bbdd mediante envio a la api.
    public void enviarActualizacion() {
        fecha = crearEntrenamientoActivity.getFechaCrearEntrenamiento();
        hora = crearEntrenamientoActivity.getEditTextHora();
        fechaHora = fecha+" "+hora;
        lugar = crearEntrenamientoActivity.getEditTextLugar();
        duracion = crearEntrenamientoActivity.getEditTextDuracion();

        String parametros = "nombre="+ Club.getClub().getNombreClub() +"&contra="+Club.getClub().getContra();
        parametros+="&fechaHora="+fechaHora+"&lugar="+lugar+"&duracion="+duracion;

        api = new API(API.CREAR_ENTRENAMIENTO_URL, parametros);
        String respuesta = api.getRespuesta();
        if(!respuesta.equalsIgnoreCase(API.ACTUALIZACION_EXITOSA)){
            crearEntrenamientoActivity.lanzarToast(API.ERROR_CONEXION+": Crear Entrenamiento");
        }else if(respuesta.equals("")){
            crearEntrenamientoActivity.lanzarToast(API.ERROR_CONEXION+"MegaErrooor 3");
        }

    }
}
