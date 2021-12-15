<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpedientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expedientes', function (Blueprint $table) {
            $table->id();
            $table->string('folio');
            $table->string('juez');
            $table->string('juzgado');
            $table->string('actor');
            $table->string('demandado');
            $table->string('secretario');

            $table->unsignedBigInteger('juicio_id');
            $table->foreign('juicio_id')->references('id')->on('tipo_juicios')->onUpdate('cascade')->onDelete('cascade');

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
        Schema::dropIfExists('expedientes');
    }
}
