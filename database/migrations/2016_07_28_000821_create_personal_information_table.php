<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonalInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personal_information', function (Blueprint $table) {
            $table->increments('id');
            $table->string('firt_name');      // Nombre
            $table->string('last_name');      // Apellido
            $table->string('birth_place');    //  Lugar de nacimiento
            $table->string('nationality');    // Nacionalidad
            $table->string('profession');     // profesion
            $table->string('address');        // Domicilio
            $table->string('civil_status');   // Estado civil
            $table->string('mother_name');    // Nombre MADRE
            $table->string('father_name');    // Nombre Padre
            $table->string('identity card');  // Documento de identidad

            $table->integer('user_id')->unsigned();
              $table->foreign('user_id')
              ->references('id')
              ->on('users')
              ->onDelete('cascade');

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
        Schema::drop('personal_information');
    }
}
