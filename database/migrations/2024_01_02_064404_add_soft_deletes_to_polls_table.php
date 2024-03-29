<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSoftDeletesToPollsTable extends Migration
{
    public function up()
    {
        Schema::table('polls', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::table('polls', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
}
