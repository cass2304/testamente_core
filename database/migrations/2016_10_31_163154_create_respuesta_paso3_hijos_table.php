<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRespuestaPaso3HijosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_respuesta_paso3_hijos', function (Blueprint $table) {
            $table->increments('ID');
            $table->integer('ID_documento')->unsigned()->nullable();
            $table->string('nombre',100)->nullable();
            $table->enum('genero', ['femenino','masculino'])->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->string('lugar',100)->nullable();
            $table->string('departamento',100)->nullable();
            $table->string('inscripcion_renap',100)->nullable();
            $table->enum('nose_renap', ['1','0'])->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tbl_respuesta_paso3_hijos');
    }
}
