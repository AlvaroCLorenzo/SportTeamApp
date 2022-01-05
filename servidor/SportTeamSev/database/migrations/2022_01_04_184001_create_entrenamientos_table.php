<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntrenamientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entrenamientos', function (Blueprint $table) {

            $table->charset = 'utf8mb4';
            $table->engine = 'InnoDB';

            $table->id();

            $table->foreignId('club_id')
            ->constrained('clubs')
            ->cascadeOnUpdate();

            $table->timestamp('fechaHora');
            $table->float('duracion');
            $table->string('lugar');
            $table->string('observacion')->nullable();
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
        Schema::dropIfExists('entrenamientos');
    }
}
