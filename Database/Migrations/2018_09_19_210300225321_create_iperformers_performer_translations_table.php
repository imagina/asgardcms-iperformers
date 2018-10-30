<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIperformersPerformerTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('iperformers__performer_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('title');
            $table->string('slug');
            $table->text('summary');
            $table->text('description');
            $table->string('metatitle')->nullable();
            $table->text('metakeywords')->nullable();
            $table->text('metadescription')->nullable();
            // Your translatable fields

            $table->integer('performer_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['performer_id', 'locale']);
            $table->foreign('performer_id')->references('id')->on('iperformers__performers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('iperformers__performer_translations', function (Blueprint $table) {
            $table->dropForeign(['performer_id']);
        });
        Schema::dropIfExists('iperformers__performer_translations');
    }
}
