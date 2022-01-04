<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClubsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clubs', function (Blueprint $table) {

            $table->charset = 'utf8mb4';
            $table->engine = 'InnoDB';

            $table->id();
            $table->string('nombre');
            $table->string('password')->nullable();
            $table->string('deporte');
            $table->string('temporada');
            $table->unsignedBigInteger('idCategoria');
            $table->timestamps();

            $table->foreign('idCategoria')->references('id')->on('categorias');  
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clubs');
    }
}
