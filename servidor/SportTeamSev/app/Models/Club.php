<?php

namespace App\Models;

use App\Http\Controllers\ModelControllers\ConsultaController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Categoria;

class Club extends Model
{
    use HasFactory;


    //se declaran los atributos añadidos como es categoría para sustituir a categoria_id
    protected $appends = [
        'categoria'
    ];

    protected $hidden = [
        'id',
        'password',
        'categoria_id',
        'updated_at',
        'created_at'
    ];

    /*se declara la funcion con esta sintaxis para el atributo del $appends
      y se retorna el valor que quiere que tome para una instancia del modelo en concreto
    */
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
