<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreatePermisosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permisos', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('tipo_user_id');
            $table->foreign('tipo_user_id')->references('id')->on('tipo_usuarios')->onUpdate('cascade')->onDelete('cascade');

            $table->boolean('agendar')->default(true);
            $table->boolean('eliminar')->default(true);
            $table->boolean('descargar')->default(true);
            $table->boolean('cancelar')->default(true); // cancelar reservación de sala
            $table->boolean('ver_auditoria')->default(true); // Celebracion de la auditoria
            $table->boolean('ver_lista_auditoria')->default(true);
            $table->boolean('ver_reservar')->default(true);
            $table->boolean('ver_buscar')->default(true);
            $table->boolean('ver_admin')->default(true);
            $table->boolean('ver_agenda')->default(true);
            $table->boolean('ver_invitado')->default(true);
            $table->boolean('ver_config')->default(true);
            $table->boolean('ver_estadistica')->default(true); // TODO:  crear un modulo de anaisis de audiencias
            $table->timestamps();
        });

        DB::insert('insert into permisos (tipo_user_id) values (?)', [1]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permisos');
    }
}
