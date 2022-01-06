<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Categoria;

class Club extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'deporte',
        'temporada',
        'categoria_id'
    ];

    protected $hidden = [
        'password'
    ];

    public function categoria(){
        return $this->belongsTo(Categoria::class);
    } 

    public function entrenamientos(){
        return $this->hasMany(Entrenamiento::class);
    }

    public function partidos(string $tipo){

        echo($tipo);

        if(strcmp($tipo,'local') == 0){
            return $this->hasMany(Partido::class, 'local_id');
        }else if(strcmp($tipo,'visitante') == 0){
            return $this->hasMany(Partido::class, 'visitante_id');
        }
        
        

    }



}
