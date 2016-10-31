<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRespuestasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_respuestas', function (Blueprint $table) {
            $table->increments('ID');
            $table->integer('ID_documento')->unsigned()->nullable();
            $table->integer('ID_pregunta')->unsigned()->nullable();
            $table->string('respuesta')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tbl_respuestas');
    }
}
