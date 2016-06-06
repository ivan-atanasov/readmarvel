<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateListsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marvel_lists', function (Blueprint $t) {
            $t->increments('id');
            $t->integer('user_id')->unsigned();
            $t->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $t->string('title', 255);
            $t->text('comment');
            $t->string('avatar', 255);
            $t->timestamps();
            $t->softDeletes();
        });

        Schema::create('marvel_list_items', function(Blueprint $t) {
            $t->increments('id');
            $t->integer('list_id')->unsigned();
            $t->foreign('list_id')->references('id')->on('marvel_lists')->onDelete('cascade');
            $t->integer('comic_id');
            $t->integer('score'); // 1 to 10
            $t->integer('reread_value'); // 1 to 10
            $t->integer('progress');
            $t->text('comment');
            $t->date('started_at')->nullable();
            $t->date('finished_at')->nullable();
            $t->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('marvel_list_items');
        Schema::drop('marvel_lists');
    }
}
