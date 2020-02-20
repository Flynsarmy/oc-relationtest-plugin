<?php namespace Flynsarmy\RelationTest\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateTables extends Migration
{
    public function up()
    {
        Schema::create('flynsarmy_relationtest_posts', function ($table) {
            $table->increments('id');
            $table->string('type')->default('post')->index();
            $table->string('title')->default('');

            $table->timestamps();
        });

        Schema::create('flynsarmy_relationtest_terms', function ($table) {
            $table->increments('id');
            $table->string('type')->index();
            $table->string('name');

            $table->timestamps();
        });

        Schema::create('flynsarmy_relationtest_posts_terms', function ($table) {
            $table->integer('post_id')->unsigned();
            $table->integer('term_id')->unsigned();
            $table->index(['post_id', 'term_id'], 'idx_post_term_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('flynsarmy_relationtest_posts_terms');
        Schema::dropIfExists('flynsarmy_relationtest_terms');
        Schema::dropIfExists('flynsarmy_relationtest_posts');
    }
}
