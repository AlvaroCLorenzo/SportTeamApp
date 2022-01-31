<?php

namespace App\Exceptions;

class InsercionDuplicadaException extends \Exception{
    
    function __construct(string $nombreCampoUnicoViolado)
    {
        
        $mensaje = "El registro que se intenta guardar en el modelo no se puede guardar debido a que el campo $nombreCampoUnicoViolado no se puede duplicar para no violar la integridad de la lógica del modelo. Prueba a cambiar el valor de ese campo para guardar el registro en el modelo.";

        parent::__construct($mensaje);


    }

    
}