<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateControlDeConsumoDiscosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('control_de_consumo_discos', function (Blueprint $table) {
            $table->id();
            $table->string('unidad');
            $table->string('total_mb_usado');
            $table->unsignedBigInteger('expediente_id');
            $table->foreign('expediente_id')->references('id')->on('expedientes')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('control_de_consumo_discos');
    }
}
