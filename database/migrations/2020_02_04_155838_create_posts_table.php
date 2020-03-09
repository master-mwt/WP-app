<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->text('content');
            $table->bigInteger('upvote')->unsigned();
            $table->bigInteger('downvote')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('channel_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('posts', function (Blueprint $table){
            $table->foreign('user_id')
                ->references('id')->on('users');
            $table->foreign('channel_id')
                ->references('id')->on('channels');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
