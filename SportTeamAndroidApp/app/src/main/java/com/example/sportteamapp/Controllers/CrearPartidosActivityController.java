package com.example.sportteamapp.Controllers;

import android.content.Intent;
import android.view.View;
import android.widget.Toast;

import com.example.sportteamapp.API.API;
import com.example.sportteamapp.Activities.CrearPartidoActivity;
import com.example.sportteamapp.Activities.PartidosActivity;
import com.example.sportteamapp.Models.Club;
import com.example.sportteamapp.R;

public class CrearPartidosActivityController implements View.OnClickListener{

    //Atributos de la clase.
    private CrearPartidoActivity crearPartidoActivity;
    String nombreLocal, nombreVisitante, fechaHora, fecha, hora, competicion;
    private API api;
    private boolean confirmado; //confirma que se ha introducido un partido de tu equipo.

    //Constructor.
    public CrearPartidosActivityController(CrearPartidoActivity crearPartidoActivity) {
        this.crearPartidoActivity = crearPartidoActivity;
    }

    @Override
    public void onClick(View v) {
        switch (v.getId()){
            case R.id.constraintLayoutFondoCrearPartido:
                crearPartidoActivity.deshabilitarCardViewCrearPartido(false); //habilitamos el cardview de crear partido
                crearPartidoActivity.deshabilitarCardViewConfirmar(true); //deshabilitamos el cardview de confirmacion de crear partido
                break;
            case R.id.buttonCrearPartido:
                crearPartidoActivity.deshabilitarCardViewCrearPartido(true); //deshabilitamos el cardview de crear partido
                crearPartidoActivity.deshabilitarCardViewConfirmar(false); //Mostramos el cardview de confirmacion.
                break;
            case R.id.buttonConfirmarCrearPartido:

                enviarActualizacion();

                if(confirmado){
                    crearPartidoActivity.lanzarToast(crearPartidoActivity.getPARTIDO_CREADO()); //Mostramos mensaje de exito y volvemos a la vista de partidos.
                }

                Intent intent = new Intent(crearPartidoActivity, PartidosActivity.class);
                intent.setFlags(Intent.FLAG_ACTIVITY_NEW_TASK | Intent.FLAG_ACTIVITY_CLEAR_TOP);
                crearPartidoActivity.startActivity(intent);
                break;
            default:
                break;
        }
    }

    //Metodo que crea un partido en la bbdd mediante envio a la api.
    public void enviarActualizacion() {
        nombreLocal = crearPartidoActivity.getEditTextEquipoLocal();
        nombreVisitante = crearPartidoActivity.getEditTextEquipoVisitante();
        String nombreReal = Club.getClub().getNombreClub();
        //Si ha creado un partido que le pertenece se le da acceso a la actualizacion...
        if(nombreLocal.equals(nombreReal) || nombreVisitante.equals(nombreReal)){
            confirmado=true;
            fecha = crearPartidoActivity.getFechaCrearPartido();
            hora = crearPartidoActivity.getEditTextHora();
            fechaHora = fecha+" "+hora;
            competicion = crearPartidoActivity.getEditTextCompeticion();

            String parametros = "nombre="+nombreReal+"&contra="+Club.getClub().getContra();
            parametros+="&eqLocal="+nombreLocal+"&eqVisitante="+nombreVisitante+"&fechaHora="+fechaHora;
            if(!competicion.equals("")) {
                parametros += "&competicion=" + competicion;
            }

            api = new API(API.CREAR_PARTIDO_URL, parametros);
            String respuesta = api.getRespuesta();

            if(!respuesta.equalsIgnoreCase(API.ACTUALIZACION_EXITOSA)){
                crearPartidoActivity.lanzarToast(API.ERROR_CONEXION+": Crear Partido");
            }else if(respuesta.equals("")){
                crearPartidoActivity.lanzarToast(API.ERROR_CONEXION+"MegaErrooor");
            }
        //Si no lo ha escrito bien o intenta hacer trampas, se lanza mensaje de error.
        }else{
            confirmado=false;
            Toast.makeText(crearPartidoActivity, crearPartidoActivity.getERROR_NOMBRE_EQUIPOS(), Toast.LENGTH_LONG).show();
        }


    }
}
