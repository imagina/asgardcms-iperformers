<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIperformersGenreTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('iperformers__genre_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('title');
            $table->text('description')->nullable();
            // Your translatable fields

            $table->integer('genre_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['genre_id', 'locale']);
            $table->foreign('genre_id')->references('id')->on('iperformers__genres')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('iperformers__genre_translations', function (Blueprint $table) {
            $table->dropForeign(['genre_id']);
        });
        Schema::dropIfExists('iperformers__genre_translations');
    }
}
