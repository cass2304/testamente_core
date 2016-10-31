<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRespuestaPaso4FinancieroTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_respuesta_paso4_financiero', function (Blueprint $table) {
            $table->increments('ID');
            $table->integer('ID_documento')->unsigned()->nullable();
            $table->string('producto_financiero')->nullable();
            $table->enum('tiene_beneficiario', ['Si','No'])->nullable();
            $table->decimal('porcentaje', 5, 2)->nullable();
            $table->enum('cambiar_beneficiario', ['Si','No'])->nullable();
            $table->string('beneficiario',100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tbl_respuesta_paso4_financiero');
    }
}
