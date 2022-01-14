<?php

namespace App\Exceptions;

class FormatoParametroIncorrectoException extends \Exception{
    


    function __construct(array $nombresParametrosIncorrectos)
    {
        
        $mensaje = "Las siguientes parametros tienen un tipo incorrecto: ";

        foreach($nombresParametrosIncorrectos as $nombre){
            $mensaje = $mensaje." ".$nombre;
        }

        parent::__construct($mensaje);


    }

    
}