<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAditionalQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aditional_questions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nro_questions');
            $table->string('questions');
            $table->string('answer');
            $table->string('step');
            $table->string('type');
            $table->timestamps();
            $table->integer('id_documents')->unsigned();

            $table->foreign('id_documents')
            ->references('id')
            ->on('documents')
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
        Schema::drop('aditional_questions');
    }
}
