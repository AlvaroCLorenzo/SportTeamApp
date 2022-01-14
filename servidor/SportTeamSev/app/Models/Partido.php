<?php

namespace App\Models;

use App\Http\Controllers\ModelControllers\ConsultaController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partido extends Model
{
    use HasFactory;

    protected $appends = [
        'local',
        'visitante',
        'competicion'
    ];

    protected $hidden = [
        'updated_at',
        'created_at',
        'competicion_id',
        'local_id',
        'visitante_id'
    ];

    /**
     * Busca el nombre del id del club con el ron local.
     */
    public function getLocalAttribute(){
        return ConsultaController::buscarClub((int)$this->attributes['local_id'])[0]->nombre;
    }

    /**
     * Busca el nombre del id del club con el ron local.
     */
    public function getVisitanteAttribute(){
        return ConsultaController::buscarClub((int)$this->attributes['visitante_id'])[0]->nombre;
    }

    /**
     * Busca el nombre del id de la competicion en caso de que haya competicion_id.
     */
    public function getCompeticionAttribute(){

        $retorno = null;
        
        if(isset($this->attributes['competicion_id'])){

            $respuesta = ConsultaController::buscarCompeticion((int)$this->attributes['competicion_id']);

            $retorno= $respuesta[0]->nombreCompeticion;
        }

        return $retorno;
    }

    public function club(){
        return $this->belongsTo(Club::class);
    }

    public function competicione(){
        return $this->belongsTo(Competicione::class);
    }

    public function asistencia_partido(){
        return $this->hasMany(Asistencia_entrenamiento::class);
    }
}
