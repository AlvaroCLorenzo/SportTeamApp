<?php

namespace App\Models;

use App\Http\Controllers\ModelControllers\ConsultaController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Categoria;
use Illuminate\Support\Facades\Storage;
use App\Casts\Base64;

class Club extends Model
{
    use HasFactory;

    const DEFAULT_IMAGEN_USUARIO = 'user.png';



    //se declaran los atributos añadidos como es categoría para sustituir a categoria_id
    protected $appends = [
        'categoria',
        'imagen'
    ];

    protected $cast = [
        'imagen' => Base64::class
    ];


    protected $hidden = [
        'id',
        'password',
        'categoria_id',
        'updated_at',
        'created_at',
        'pathImagen'
    ];

    
    /*se declara la funcion con esta sintaxis para el atributo del $appends
      y se retorna el valor que quiere que tome para una instancia del modelo en concreto
    */

    public function getImagenAttribute(){

        //si el registro del model de la instancia tiene el atributo del path de la imagen
        if(isset($this->attributes['pathImagen'])){

            /**
             * Se recupera el fichero y se retorna en codificacion de base64 para insertarlo en el json.
             */
            return base64_encode(Storage::disk('public')->get($this->attributes['pathImagen']));

        }

        /**
         * Si no tiene una imagen asociada se retorna de la misma manera la imagen de usuario por defecto.
         */
        return base64_encode(Storage::disk('public')->get(self::DEFAULT_IMAGEN_USUARIO));
        
    }

    public function getCategoriaAttribute(){

        $respuesta = ConsultaController::buscarCategoria((int)$this->attributes['categoria_id']);

        return $respuesta[0]->nombreCategoria;
    }

    public function categoria(){
        return $this->belongsTo(Categoria::class);
    } 

    public function entrenamientos(){
        return $this->hasMany(Entrenamiento::class);
    }

    public function jugadores(){
        return $this->hasMany(Jugadore::class);
    }

    public function partidos(string $tipo){

        if(strcmp($tipo,'local') == 0){

            return $this->hasMany(Partido::class, 'local_id');

        }else if(strcmp($tipo,'visitante') == 0){
            
            return $this->hasMany(Partido::class, 'visitante_id');
        }
        
        
    }



}
