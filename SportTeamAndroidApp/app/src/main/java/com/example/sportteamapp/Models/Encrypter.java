package com.example.sportteamapp.Models;

import androidx.annotation.NonNull;
import java.security.MessageDigest;
import java.security.NoSuchAlgorithmException;

public class Encrypter {

    //Clase orientada a encriptar las passwords de la BBDD.
    //Usa el algotitmo de cifrado hash SHA-256, que pertenece al conjunto de SHA-2 el cual fue diseñado por la NSA.
    //Su función es crear una cadena resumen (digest) del texto original (En este caso la password).
    //Este valor resultante tiene una longitud fija y no se puede obtener la cadena original, ni su longitud a partir de este.
    //Esta función hash está pensada para que sea posible una encriptacion muy consistente,
    // y una dificil desencriptacion, por lo que para encriptar las passwords de la app en la BBDD es idonea.
    //(Sólo es posible desencriptar las cadenas comparando hashes (DIFICIL TAREA)).
    //PARA ELLO USO EL PAQUETE: java.security

    //Atributos de la clase.
    private final String ALGORITMO_SHA256 = "SHA-256";

    //Contructor.
    public Encrypter(){
    }

    //Metodo que recibe un parámetro (password) sin codificar y devuelve la cadena generada mediante el algoritmo SHA-256.
    public String encryptSHA256(@NonNull String password){
        try{
            //Creo una instancia de Message Diggest, clase que me permite recoger el algoritmo de codificado y realizar metodos con él.
            MessageDigest md = MessageDigest.getInstance(ALGORITMO_SHA256);

            //Recojo el resultado del algoritmo en un array de bytes.
            byte[] hash = md.digest(password.getBytes()); //Mando la cadena al algoritmo en forma de bytes.

            //Creo un StringBuffer para recoger la password encriptada usando su funcion append().
            StringBuffer hashedPassword = new StringBuffer();

            //Añado al String cada byte del array de bytes anterior, obteniendo la cadena codificada de nuestra password.
            for (byte b : hash) {
                hashedPassword.append(String.format("%02x" ,b)); //Añado cada byte con String.format(x) x=hexadecimal
            }

            return hashedPassword.toString(); //Retorno la cadena hash resultante.

            //Si no existiese el algoritmo indicado al crear el Message Diggest, podría ocurrir una excepcion.
        }catch (NoSuchAlgorithmException ex){
            System.out.println("ERROR: No existe dicho algoritmo de encriptacion.");;
            ex.printStackTrace();
            return  null;
        }
    }

}

