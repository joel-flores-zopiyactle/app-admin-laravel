<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonalAudienciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personal_audiencias', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->unsignedBigInteger('rol_personal_id');
            $table->foreign('rol_personal_id')->references('id')->on('roles_personals')->onUpdate('cascade')->onDelete('cascade');

            $table->unsignedBigInteger('audiencia_id');
            $table->foreign('audiencia_id')->references('id')->on('audiencias')->onUpdate('cascade')->onDelete('cascade');

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
        Schema::dropIfExists('personal_audiencias');
    }
}
