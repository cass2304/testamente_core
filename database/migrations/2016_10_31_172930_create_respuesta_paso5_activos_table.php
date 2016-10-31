<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRespuestaPaso5ActivosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_respuesta_paso5_activos', function (Blueprint $table) {
          $table->increments('ID');
          $table->integer('ID_documento')->unsigned()->nullable();
          $table->string('activo')->nullable();
          $table->decimal('monto', 5, 2)->nullable();
          $table->string('beneficiario')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tbl_respuesta_paso5_activos');
    }
}
