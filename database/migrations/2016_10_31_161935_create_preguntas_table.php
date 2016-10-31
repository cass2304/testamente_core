<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePreguntasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_preguntas', function (Blueprint $table) {
            $table->increments('ID');
            $table->integer('paso')->unsigned()->nullable();
            $table->integer('nro_pregunta')->unsigned()->nullable();
            $table->integer('sub_pregunta')->unsigned()->nullable();
            $table->string('pregunta',150)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tbl_preguntas');
    }
}
