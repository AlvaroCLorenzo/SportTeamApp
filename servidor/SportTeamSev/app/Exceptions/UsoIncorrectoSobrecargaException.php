<?php

namespace App\Exceptions;

class UsoIncorrectoSobrecargaException extends \Exception{
    
    function __construct()
    {
        
        $mensaje = "Uso incorrecto de la sobrecarga de los parametros de entrada de la función/método, el método no está preparado para es combinación de parámetros.";

        parent::__construct($mensaje);


    }

    
}