<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAsistenciaPartidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asistencia_partidos', function (Blueprint $table) {

            $table->charset = 'utf8mb4';
            $table->engine = 'InnoDB';

            $table->id();
            $table->unsignedBigInteger('idPartido');
            $table->unsignedBigInteger('idJugador');
            $table->boolean('asistido')->nullable()->default(0);
            $table->boolean('justificado')->nullable()->default(0);
            $table->timestamps();

            $table->foreign('idPartido')->references('id')->on('partidos');
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
        Schema::dropIfExists('asistencia_partidos');
    }
}
