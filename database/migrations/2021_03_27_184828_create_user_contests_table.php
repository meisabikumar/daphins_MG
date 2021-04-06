<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserContestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_contests', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->string('contest_id');
            $table->string('match_id');
            $table->string('game_type');
            $table->float('entry_fee',5,2);
            $table->json('players');
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
        Schema::dropIfExists('user_contests');
    }
}
