<?php

namespace App\Models;

use App\Http\Controllers\ModelControllers\ConsultaController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Partido extends Model
{
    use HasFactory;

    protected $appends = [
        'local',
        'visitante',
        'competicion',
        'pathImagenLocal',
        'pathImagenVisitante',
        'imagenLocal',
        'imagenVisitante'
    ];

    protected $hidden = [
        'updated_at',
        'created_at',
        'competicion_id',
        'local_id',
        'visitante_id'
    ];


    public function getPathImagenLocalAttribute(){
        return ConsultaController::buscarClub((int)$this->attributes['local_id'])[0]->pathImagen;
    }

    public function getPathImagenVisitanteAttribute(){
        return $pathImagen = ConsultaController::buscarClub((int)$this->attributes['visitante_id'])[0]->pathImagen;
    }


    public function getImagenLocalAttribute(){

        $pathImagen = ConsultaController::buscarClub((int)$this->attributes['local_id'])[0]->pathImagen;

        //si el registro del model de la instancia tiene el atributo del path de la imagen
        if(isset($pathImagen)){

            /**
             * Se recupera el fichero y se retorna en codificacion de base64 para insertarlo en el json.
             */
            return base64_encode(Storage::disk('public')->get($pathImagen));

        }

        /**
         * Si no tiene una imagen asociada se retorna de la misma manera la imagen de usuario por defecto.
         */
        return base64_encode(Storage::disk('public')->get(Club::DEFAULT_IMAGEN_USUARIO));
    }

    public function getImagenVisitanteAttribute(){

        $pathImagen = ConsultaController::buscarClub((int)$this->attributes['visitante_id'])[0]->pathImagen;

        //si el registro del model de la instancia tiene el atributo del path de la imagen
        if(isset($pathImagen)){

            /**
             * Se recupera el fichero y se retorna en codificacion de base64 para insertarlo en el json.
             */
            return base64_encode(Storage::disk('public')->get($pathImagen));

        }

        /**
         * Si no tiene una imagen asociada se retorna de la misma manera la imagen de usuario por defecto.
         */
        return base64_encode(Storage::disk('public')->get(Club::DEFAULT_IMAGEN_USUARIO));

    }

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
