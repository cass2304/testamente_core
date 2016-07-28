<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property', function (Blueprint $table) {
          $table->increments('id');
          $table->string('description');
          $table->string('nro_finca');
          $table->string('nro_folio');
          $table->string('nro_libro');
          $table->string('adress');

          $table->integer('user_id')->unsigned();
          $table->integer('beneficiary_id')->unsigned();

          $table->foreign('user_id')
            ->references('id')
            ->on('users')
            ->onDelete('cascade');

          $table->foreign('beneficiary_id')
              ->references('id')
              ->on('beneficiary')
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
        Schema::drop('property');
    }
}
