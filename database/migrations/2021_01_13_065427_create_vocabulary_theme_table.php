<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVocabularyThemeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vocabulary_theme', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
            $table->bigIncrements('id');
            $table->string('name', 255)->nullable();
            $table->bigInteger('language_id')->unsigned();
            $table->foreign('language_id')->references('id')->on('vocabulary_language')->onDelete('cascade');
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

//        Schema::table('vocabulary_theme', function ($table) {
//            $table->foreign('language_id')->references('id')->on('vocabulary_language')->onDelete('cascade');
//            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vocabulary_theme');
    }
}
