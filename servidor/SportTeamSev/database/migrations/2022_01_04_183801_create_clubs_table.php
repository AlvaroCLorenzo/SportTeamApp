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
            $table->string('deporte')->nullable();
            $table->string('temporada')->nullable();
            $table->string('pathImagen')->nullable();
            
            $table->foreignId('categoria_id')
                ->nullable()
                ->constrained('categorias')
                ->cascadeOnUpdate();

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
        Schema::dropIfExists('clubs');
    }
}
