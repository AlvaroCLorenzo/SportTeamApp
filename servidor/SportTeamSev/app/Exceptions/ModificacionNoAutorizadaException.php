<?php

namespace App\Exceptions;

class ModificacionNoAutorizadaException extends \Exception{
    
    function __construct()
    {
        
        $mensaje = "La modificación no se puede realizar por el actor que intenta ejecutarla, es debido a que dicho registro no le pertenece.";

        parent::__construct($mensaje);


    }

    
}

?>