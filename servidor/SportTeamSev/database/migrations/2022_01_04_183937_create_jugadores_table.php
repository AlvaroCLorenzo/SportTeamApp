<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJugadoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jugadores', function (Blueprint $table) {

            $table->charset = 'utf8mb4';
            $table->engine = 'InnoDB';

            $table->id();
            
            $table->foreignId('club_id')
            ->constrained('clubs')
            ->cascadeOnUpdate();

            $table->string('nombre');
            $table->string('apellidos');
            $table->string('telefono');
            $table->timestamp('fechaNacimiento');
            $table->timestamps();

            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jugadores');
    }
}
