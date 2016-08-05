<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAditionalQuestionsDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aditional_questions_detail', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_documents')->unsigned();
            $table->string('label');
            $table->string('value');
            $table->timestamps();
            $table->foreign('id_documents')
            ->references('id_documents')
            ->on('aditional_questions')
            ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('aditional_questions_detail');
    }
}
