<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAsistenciaPersonalAudienciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asistencia_personal_audiencias', function (Blueprint $table) {
            $table->id();
            $table->string('asistencia'); // asistencia, retardo , falta
            $table->string('color'); // success, warning, danger
            $table->unsignedBigInteger('personal_id');
            $table->foreign('personal_id')->references('id')->on('personal_audiencias')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('asistencia_personal_audiencias');
    }
}
