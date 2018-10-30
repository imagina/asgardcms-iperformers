<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIperformersTypeTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('iperformers__type_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('title');
            $table->string('slug');
            $table->text('description')->nullable();
            $table->string('metatitle');
            $table->text('metakeywords');
            $table->text('metadescription');
            // Your translatable fields

            $table->integer('type_id')->unsigned();

            $table->string('locale')->index();
            $table->unique(['type_id', 'locale']);
            $table->foreign('type_id')->references('id')->on('iperformers__types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('iperformers__type_translations', function (Blueprint $table) {
            $table->dropForeign(['type_id']);
        });
        Schema::dropIfExists('iperformers__type_translations');
    }
}
