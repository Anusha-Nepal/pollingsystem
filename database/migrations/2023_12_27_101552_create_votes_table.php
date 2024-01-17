<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVotesTable extends Migration
{
    public function up()
    {
        Schema::create('votes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('polls_id');
            $table->unsignedBigInteger('choice_id');

      
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('polls_id')->references('id')->on('polls');
            $table->foreign('choice_id')->references('id')->on('choices');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('votes');
    }
}
