<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRespuestaDetalleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_respuesta_detalle', function (Blueprint $table) {
            $table->increments('ID_detalle');
            $table->integer('ID_respuesta')->unsigned()->nullable();
            $table->string('respuesta')->nullable();
            $table->string('label')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tbl_respuesta_detalle');
    }
}
