<?php

namespace App\Exceptions;

class ModificacionNoAutorizadaException extends \Exception{
    
    function __construct()
    {
        
        $mensaje = "El actor que intenta realizar la modificación no tiene permiso de modificación sobre el registro que quiere modificar, esto es debido a que no le pertenece.";

        parent::__construct($mensaje);


    }

    
}

?>