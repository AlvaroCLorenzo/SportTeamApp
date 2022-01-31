package com.example.sportteamapp.Models;

import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.util.Base64;

import com.google.gson.annotations.Expose;

import java.io.Serializable;

public class Partido implements Serializable {

    //Atrinutos de la clase.
    @Expose
    private String id;
    @Expose
    private String fechaHora;
    private String fecha;
    private String hora;
    @Expose
    private String resultado;
    private String resultado1;
    private String resultado2;
    @Expose
    private String observacion;
    @Expose
    private String local;
    @Expose
    private String visitante;
    @Expose
    private String competicion;
    @Expose
    private String imagenLocal;
    @Expose
    private String imagenVisitante;


    //Constructor.
    public Partido(String id, String fechaHora, String resultado, String observacion, String local, String visitante, String competicion, String imagenLocal, String imagenVisitante) {
        this.id = id;

        this.fechaHora = fechaHora;

        this.resultado = resultado;

        this.observacion = observacion;

        this.local = local;
        this.visitante = visitante;

        this.competicion = competicion;

        this.imagenLocal = imagenLocal;
        this.imagenVisitante = imagenVisitante;
    }

    //Metodo que decodifica en Base64.
    private Bitmap transformarBase64aBitmap(String cadenaBase64) {
        byte[] decodedByte = Base64.decode(cadenaBase64, 0);
        return BitmapFactory.decodeByteArray(decodedByte, 0, decodedByte.length);
    }

    //Getters.
    public Bitmap getImagenLocalBitmap(){
        return transformarBase64aBitmap(this.imagenLocal);
    }

    public Bitmap getImagenVisitanteBitmap(){
        return transformarBase64aBitmap(this.imagenVisitante);
    }

    public String getId() {
        return id;
    }

    public String getLocal() {
        return local;
    }

    public String getVisitante() {
        return visitante;
    }

    public String getResultado1() {
        try{
            String[] trozos = this.resultado.split(":");
            resultado1 = trozos[0];
        }catch (Exception e){
        }
        return resultado1;
    }

    public String getResultado2() {
        try{
            String[] trozos = this.resultado.split(":");
            resultado2 = trozos[1];
        }catch (Exception e){

        }
        return resultado2;
    }

    public String getCompeticion() {
        return competicion;
    }

    public String getFecha() {
        try{
            String[] trozos = this.fechaHora.split(" ");
            fecha = trozos[0];
        }catch (Exception e){
            e.printStackTrace();
        }
        return fecha;
    }

    public String getHora() {
        try{
            String[] trozos = this.fechaHora.split(" ");
            hora = trozos[1];
        }catch (Exception e){
            e.printStackTrace();
        }
        return hora;
    }

    public String getImagenLocal() {
        return imagenLocal;
    }

    public String getImagenVisitante() {
        return imagenVisitante;
    }

    public String getFechaHora() {
        return fechaHora;
    }

    public String getResultado() {
        return resultado;
    }

    public String getObservacion() {
        return observacion;
    }

    //Setters.
    public void setObservacion(String observacion) {
        this.observacion = observacion;
    }


}
