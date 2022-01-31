package com.example.sportteamapp.Models;

import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.util.Base64;
import android.widget.ImageView;

import com.google.gson.annotations.Expose;

public final class Club {

    //Atributos de la clase.
    @Expose
    private String nombre;

    private String contra;
    @Expose
    private String deporte;
    @Expose
    private String temporada;
    @Expose
    private String categoria;
    @Expose
    private String imagen;

    private ImageView imageView;

    //Creamos el club.
    private static Club myClub = new Club();

    //Aun siendo singleton, se podrán crear instancias para trabajar con gson.
    public Club(){
    }

    //Constructor singleton.
    public static Club getClub() {
        return myClub;
    }

    //Metodo que decodifica en Base64.
    public static Bitmap getImagenBitmap() {
        byte[] decodedByte = Base64.decode(Club.getClub().getImagenCodificada(), 0);
        return BitmapFactory.decodeByteArray(decodedByte, 0, decodedByte.length);
    }

    //Getters
    public static Club getMyClub() {
        return myClub;
    }

    public static void setMyClub(Club myClub) {
        Club.myClub = myClub;
    }

    public String getNombreClub() {
        return nombre;
    }

    public void setNombreClub(String nombreClub) {
        this.nombre = nombreClub;
    }

    public String getContra() {
        return contra;
    }

    public void setContra(String contra) {
        this.contra = contra;
    }

    public String getDeporte() {
        return deporte;
    }

    public void setDeporte(String deporte) {
        this.deporte = deporte;
    }

    public String getTemporada() {
        return temporada;
    }

    public void setTemporada(String temporada) {
        this.temporada = temporada;
    }

    public String getCategoria() {
        return categoria;
    }

    public void setCategoria(String categoria) {
        this.categoria = categoria;
    }

    public String getImagenCodificada() {
        return imagen;
    }

    public void setImagenCodificada(String imagenCodificada) {
        this.imagen = imagenCodificada;
    }

    public ImageView getImageView() {
        return imageView;
    }

    public void setImageView(ImageView imageView) {
        this.imageView = imageView;
    }
}
