package com.example.sportteamapp.Controllers;

import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.view.View;

import com.example.sportteamapp.API.API;
import com.example.sportteamapp.Activities.IndexActivity;
import com.example.sportteamapp.Activities.MainActivity;
import com.example.sportteamapp.Models.Club;
import com.example.sportteamapp.Models.Encrypter;
import com.example.sportteamapp.R;
import com.google.gson.Gson;
import com.google.gson.GsonBuilder;

public class MainActivityController implements View.OnClickListener{

    //Constantes de configuracion.
    private final String LOGIN_DENEGADO = "denegado";

    //Atributos de la clase
    private MainActivity mainActivity;
    private API api;
    private String respuesta;
    private Encrypter encrypter;
    private SharedPreferences sharedPreferences;

    private Gson gson;
    private Intent intent;

    //Constructor.
    public MainActivityController(MainActivity mainActivity){
        this.mainActivity = mainActivity;
        this.sharedPreferences = mainActivity.getSharedPreferences(mainActivity.getString(R.string.preferences_sportteamapp_file_key), Context.MODE_PRIVATE);
        this.encrypter = new Encrypter();
    }

    @Override
    public void onClick(View v) {
        switch (v.getId()){
            case R.id.buttonLogin:
                String nombre = mainActivity.getEditTextClub();
                String contra = mainActivity.getEditTextPassword();

                //Ciframos la pass del usuario con sha-256 para compararla con la bbdd.
                String hashedContra = encrypter.encryptSHA256(contra);
                String parametro = "nombre="+nombre+"&contra="+hashedContra;

                api = new API(API.LOGIN_URL, parametro);
                respuesta = api.getRespuesta();

                //Si la conexion fue exitosa...
                if(respuesta!=null && !respuesta.equals("")){
                    //Si el login fue exitoso...
                    if(!respuesta.equals(LOGIN_DENEGADO)){
                        //Creamos nuesttro club...
                        crearMyClub(respuesta, hashedContra);
                        //Si eligio guardar sesion...
                        if(mainActivity.switchIsChecked()){
                            guardarSharedPreferences(nombre, hashedContra); //Guardamos en el fichero shared preferences
                        }
                        goLogin();

                    //Si se denego...
                    }else{
                        mainActivity.vaciarCampos();
                        mainActivity.lanzarToast(mainActivity.getMENSAJE_ERROR_LOGIN());
                    }

                //Si hubo un error de conexion...
                }else{
                    mainActivity.lanzarToast(API.ERROR_CONEXION);
                }
                break;
            default:
                break;
        }
    }

    public void crearMyClub(String respuesta, String hashedContra){
        gson = new GsonBuilder().excludeFieldsWithoutExposeAnnotation().create();
        Club.setMyClub(gson.fromJson(respuesta, Club.class));
        Club.getClub().setContra(hashedContra);
    }

    private void guardarSharedPreferences(String nombre, String hashedcontra) {
        SharedPreferences.Editor editor = sharedPreferences.edit();
        editor.putString(mainActivity.getString(R.string.nombre_key), nombre);
        editor.putString(mainActivity.getString(R.string.contra_key), hashedcontra);
        editor.commit();
    }

    //Metodo para leer del fichero SharedPreferences los datos del login.
    //Recibe la clave del dato por parametro.
    private String readData(String key){
        String data = sharedPreferences.getString(key, "");
        return data;
    }

    //Metodo que comprueba si hay un usuario recordado.
    private boolean comprobarUsuarioRecordado() {
        if(readData(mainActivity.getString(R.string.nombre_key)).equals("")){
            return false;
        }
        return true;
    }

    //Metodo que realiza la accion correspondiente despues de comprobar si hay un usuario recordado.
    public void recordarDatos() {
        //Si en el archivo SharedPreferences hubiese un campo relleno de usuario, se rellenan los datos automaticamente...
        if(comprobarUsuarioRecordado()){
            String club = readData(mainActivity.getString(R.string.nombre_key)); //Recojo del fichero el nombre y el hash de la contra.
            String contra = readData(mainActivity.getString(R.string.contra_key));

            String parametro = "nombre="+club+"&contra="+contra;
            api = new API(API.LOGIN_URL, parametro);
            respuesta = api.getRespuesta();

            //Si la conexion fue exitosa...
            if(respuesta!=null && !respuesta.equals("")){
                crearMyClub(respuesta, contra); //creo un club
                goLogin(); //hacemos login directamente.
            //Si hubo un error de conexion...
            }else{
                mainActivity.lanzarToast(API.ERROR_CONEXION);
            }
        }
    }

    //Metodo que realiza el cambio de activity respectivo al login.
    public void goLogin(){
        mainActivity.lanzarToast(mainActivity.getMENSAJE_EXITO());
        intent = new Intent(mainActivity, IndexActivity.class);
        mainActivity.startActivity(intent);
    }
}
