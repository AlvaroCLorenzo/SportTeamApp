<?php

namespace App\Exceptions;

class ClaveForaneaNullaException extends \Exception{
    


    function __construct(array $nombresClavesNulas)
    {
        
        $mensaje = "Las siguientes claves foraneas no se encuentran en las tablas relacionadas: ";

        foreach($nombresClavesNulas as $nombre){
            $mensaje = $mensaje." ".$nombre;
        }

        parent::__construct($mensaje);


    }

    
}

