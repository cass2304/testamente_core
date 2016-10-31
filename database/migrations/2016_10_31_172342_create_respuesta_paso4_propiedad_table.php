<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRespuestaPaso4PropiedadTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_respuesta_paso4_propiedad', function (Blueprint $table) {
          $table->increments('ID');
          $table->integer('ID_documento')->unsigned()->nullable();
          $table->string('pais')->nullable();
          $table->string('domicilio')->nullable();
          $table->string('nro_finca')->nullable();
          $table->string('nro_folio')->nullable();
          $table->string('nro_libro')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tbl_respuesta_paso4_propiedad');
    }
}
