<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Fixture extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fixture', function (Blueprint $table) {
            $table->increments('id');
            $table->string('fixture_id',50)->nullable();
            $table->string('league_id',50)->nullable();
            $table->string('season_id',50)->nullable();
            $table->string('stage_id',50)->nullable();
            $table->string('round_id',50)->nullable();
            $table->string('group_id',50)->nullable();
            $table->string('aggregate_id',50)->nullable();
            $table->string('venue_id',50)->nullable();
            $table->string('referee_id',50)->nullable();
            $table->string('localteam_id',50)->nullable();
            $table->string('visitorteam_id',50)->nullable();
            $table->string('winner_team_id',50)->nullable();
            $table->string('commentaries',50)->nullable();
            $table->string('attendance',50)->nullable();
            $table->string('pitch',50)->nullable();
            $table->string('details',50)->nullable();
            $table->string('neutral_venue',50)->nullable();
            $table->string('leg',50)->nullable();
            $table->string('colors',50)->nullable();
            $table->string('deleted',50)->nullable();
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
        Schema::dropIfExists('fixture');
    }
}
