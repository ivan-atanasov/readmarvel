<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStaticPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('static_pages', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('created_by')->unsigned();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->integer('last_updated_by')->unsigned()->nullable();
            $table->foreign('last_updated_by')->references('id')->on('users')->onDelete('cascade');
            $table->string('url_slug', 255);
            $table->string('label', 255);
            $table->string('title', 255);
            $table->text('content');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('static_pages');
    }
}
