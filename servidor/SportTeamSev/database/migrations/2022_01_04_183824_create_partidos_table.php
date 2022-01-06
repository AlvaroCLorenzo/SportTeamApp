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

            $table->foreignId('local_id')
                ->nullable()
                ->constrained('clubs')
                ->cascadeOnUpdate();

            $table->foreignId('visitante_id')
                ->nullable()
                ->constrained('clubs')
                ->cascadeOnUpdate();

            $table->foreignId('competicion_id')
                ->nullable()
                ->constrained('competiciones')
                ->cascadeOnUpdate();
                
            $table->timestamp('fechaHora');
            $table->string('resultado')->nullable();
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
        Schema::dropIfExists('partidos');
    }
}
