package com.example.sportteamapp.API;

import android.os.AsyncTask;

import com.example.sportteamapp.Models.Convocado;
import com.example.sportteamapp.Models.Entrenamiento;
import com.example.sportteamapp.Models.Jugador;
import com.example.sportteamapp.Models.Partido;
import com.google.gson.Gson;
import com.google.gson.GsonBuilder;
import com.google.gson.reflect.TypeToken;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.io.OutputStream;
import java.io.Serializable;
import java.lang.reflect.Type;
import java.net.HttpURLConnection;
import java.net.URL;
import java.nio.charset.StandardCharsets;
import java.util.ArrayList;

public class API extends AsyncTask<String, String , String> implements Serializable {

    //Constantes de configuración.
    public static final String BASE_URL = "http://172.16.0.233/api/";
    public static final String LOGIN_URL = BASE_URL+"login";

    public static final String PARTIDOS_URL = BASE_URL+"partidos";
    public static final String ENTRENAMIENTOS_URL = BASE_URL+"entrenamientos";
    public static final String JUGADORES_URL = BASE_URL+"jugadores";

    public static final String ACTUALIZAR_PARTIDO_URL = BASE_URL+"actualizarPartido";
    public static final String ACTUALIZAR_ENTRENAMIENTO_URL = BASE_URL+"actualizarEntrenamiento";
    public static final String ACTUALIZAR_JUGADOR_URL = BASE_URL+"actualizarJugador";

    public static final String CREAR_PARTIDO_URL = BASE_URL+"insertarPartido";
    public static final String CREAR_ENTRENAMIENTO_URL = BASE_URL+"insertarEntrenamiento";
    public static final String CREAR_JUGADOR_URL = BASE_URL+"insertarJugador";

    public static final String CONVOCATORIA_PARTIDO_URL = BASE_URL+"convocatoriaPartido";
    public static final String CONVOCATORIA_ENTRENAMIENTO_URL = BASE_URL+"convocatoriaEntrenamiento";

    public static final String ACTUALIZAR_CONVOCATORIA_PARTIDO_URL = BASE_URL+"actualizarConvocatoriaPartido";
    public static final String ACTUALIZAR_CONVOCATORIA_ENTRENAMIENTO_URL = BASE_URL+"actualizarConvocatoriaEntrenamiento";

    public static final String INSERTAR_CONVOCATORIA_PARTIDO_URL = BASE_URL+"insertarConvocatoriaPartido";
    public static final String INSERTAR_CONVOCATORIA_ENTRENAMIENTO_URL = BASE_URL+"insertarConvocatoriaEntrenamiento";

    public static final String ERROR_CONEXION = "Error de conexión";
    public static final String ACTUALIZACION_EXITOSA = "actualizacion exitosa";


    private final Type TIPO_LISTA_PARTIDOS = new TypeToken<ArrayList<Partido>>(){}.getType();
    private final Type TIPO_LISTA_ENTRENAMIENTO = new TypeToken<ArrayList<Entrenamiento>>(){}.getType();
    private final Type TIPO_LISTA_JUGADOR = new TypeToken<ArrayList<Jugador>>(){}.getType();
    private final Type TIPO_LISTA_CONVOCADO = new TypeToken<ArrayList<Convocado>>(){}.getType();

    //Atributos de la clase.
    private ArrayList<Partido> partidos;
    private ArrayList<Entrenamiento> entrenamientos;
    private ArrayList<Jugador> jugadores;
    private ArrayList<Convocado> convocados;

    //private String respuesta;
    private HttpURLConnection httpURLConnection;
    private int codigoHTTP;

    private StringBuilder respuesta;

    private Gson gson;

    private boolean conexionTerminada;

    //Constructor que genera la conexión a la API.
    public API(String url, String parametros){
        gson = new GsonBuilder().excludeFieldsWithoutExposeAnnotation().create();
        this.getConexion(url, parametros);
    }

    //Hacemos la conexión en el background porque asi lo prefiere Android, ya que el delay puede ser imprececible y podria
    //congelar la interfaz de usuario.
    @Override
    protected String doInBackground(String... strings) {

        URL url = null;
        byte[] data = strings[1].getBytes(StandardCharsets.UTF_8);

        try{
            httpURLConnection = null;
            OutputStream out = null;
            InputStream in = null;
            respuesta = new StringBuilder();

            httpURLConnection = (HttpURLConnection) new URL(strings[0]).openConnection();
            httpURLConnection.setRequestMethod("POST");
            httpURLConnection.setRequestProperty("Content-Type", "application/x-www-form-urlencoded");
            httpURLConnection.setUseCaches(false);
            httpURLConnection.setConnectTimeout(5000);
            httpURLConnection.setReadTimeout(5000);
            httpURLConnection.setDoOutput(true);


            out = httpURLConnection.getOutputStream();
            out.write(data);
            out.close();

            codigoHTTP = httpURLConnection.getResponseCode();
            if(codigoHTTP==HttpURLConnection.HTTP_OK){
                in = httpURLConnection.getInputStream();
                BufferedReader reader = new BufferedReader(new InputStreamReader(in));
                String line = null;

                while ((line = reader.readLine()) != null) {
                    respuesta.append(line);
                }
                reader.close();
                if (out != null) out.close();
                if (in != null) in.close();
                if (httpURLConnection != null) httpURLConnection.disconnect();

            }

        }catch(IOException exception){
            exception.printStackTrace();
        }
        conexionTerminada = true;
        return null;
    }

    //Metodo que establece la conexion con la api con una determinada URL.
    private void getConexion(String url, String parametros){
        conexionTerminada = false;
        try{
            this.execute(url, parametros).get();
            //Mientras la conexion no se haya terminado, no se sale de este método para evitar errores.
            while(!conexionTerminada){
            }
        }catch(Exception e){
            e.printStackTrace();
        }
    }

    //Getters.
    public String getRespuesta() {
        return respuesta.toString();
    }

    public ArrayList<Partido> getPartidos() {
        partidos = gson.fromJson(respuesta.toString(), TIPO_LISTA_PARTIDOS);
        return partidos;
    }

    public ArrayList<Entrenamiento> getEntrenamientos() {
        entrenamientos = gson.fromJson(respuesta.toString(), TIPO_LISTA_ENTRENAMIENTO);
        return entrenamientos;
    }

    public ArrayList<Jugador> getJugadores() {
        jugadores = gson.fromJson(respuesta.toString(), TIPO_LISTA_JUGADOR);
        return jugadores;
    }

    public ArrayList<Convocado> getConvocados(){
        convocados = gson.fromJson(respuesta.toString(), TIPO_LISTA_CONVOCADO);
        return convocados;
    }
}
