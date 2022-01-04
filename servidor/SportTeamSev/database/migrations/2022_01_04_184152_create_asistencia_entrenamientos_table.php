<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAsistenciaEntrenamientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asistencia_entrenamientos', function (Blueprint $table) {

            $table->charset = 'utf8mb4';
            $table->engine = 'InnoDB';

            $table->id();
            $table->unsignedBigInteger('idEntrenamiento');
            $table->unsignedBigInteger('idJugador');
            $table->boolean('asistido')->nullable()->default(0);
            $table->boolean('justificado')->nullable()->default(0);
            $table->timestamps();

            $table->foreign('idEntrenamiento')->references('id')->on('entrenamientos');
            $table->foreign('idJugador')->references('id')->on('jugadores');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('asistencia_entrenamientos');
    }
}
