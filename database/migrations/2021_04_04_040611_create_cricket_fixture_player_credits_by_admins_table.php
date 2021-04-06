<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCricketFixturePlayerCreditsByAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cricket_fixture_player_credits_by_admins', function (Blueprint $table) {
            $table->id();
            $table->string('match_id')->nullable();
            $table->string('team_id')->nullable();
            $table->string('team_name')->nullable();
            $table->string('player_id')->nullable();
            $table->string('player_name')->nullable();
            $table->string('position')->nullable();
            $table->string('credit')->nullable();
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
        Schema::dropIfExists('cricket_fixture_player_credits_by_admins');
    }
}
