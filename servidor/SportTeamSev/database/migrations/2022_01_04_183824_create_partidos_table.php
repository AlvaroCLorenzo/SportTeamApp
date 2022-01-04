<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partidos', function (Blueprint $table) {

            $table->charset = 'utf8mb4';
            $table->engine = 'InnoDB';

            $table->id();
            $table->unsignedBigInteger('idLocal');
            $table->unsignedBigInteger('idVisitante');
            $table->unsignedBigInteger('idCompeticion');
            $table->timestamp('fechaHora');
            $table->string('resultado')->nullable();
            $table->string('observacion')->nullable();
            $table->timestamps();

            $table->foreign('idLocal')->references('id')->on('clubs');
            $table->foreign('idVisitante')->references('id')->on('clubs');
            $table->foreign('idCompeticion')->references('id')->on('competiciones');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('partidos');
    }
}
