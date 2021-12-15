<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAudienciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('audiencias', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('centroJusticia_id');
            $table->foreign('centroJusticia_id')->references('id')->on('centro_justicias')->onUpdate('cascade')->onDelete('cascade');

            $table->unsignedBigInteger('sala_id');
            $table->foreign('sala_id')->references('id')->on('salas')->onUpdate('cascade')->onDelete('cascade');

            $table->unsignedBigInteger('tipo_id');
            $table->foreign('tipo_id')->references('id')->on('tipo_audiencias')->onUpdate('cascade')->onDelete('cascade');

            $table->unsignedBigInteger('expediente_id');
            $table->foreign('expediente_id')->references('id')->on('expedientes')->onUpdate('cascade')->onDelete('cascade');

            $table->unsignedBigInteger('estadoAudiencia_id');
            $table->foreign('estadoAudiencia_id')->references('id')->on('estado_audiencias')->onUpdate('cascade')->onDelete('cascade');

            $table->date('fechaCelebracion');
            $table->timeTz('horaInicio', $precision = 0);
            $table->timeTz('horaFinalizar', $precision = 0);
        
            $table->boolean('estado')->default(true);
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
        Schema::dropIfExists('audiencias');
    }
}
