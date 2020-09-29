<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFriendListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('friend_lists', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id_from')->unsigned()->index('user_id_from_users');
            $table->foreign('user_id_from')->references('id')->on('users');
            $table->bigInteger('user_id_to')->unsigned()->index('user_id_to_users');
            $table->foreign('user_id_to')->references('id')->on('users');
            $table->boolean('status')->default('0');
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
        Schema::dropIfExists('friend_lists');
    }
}
