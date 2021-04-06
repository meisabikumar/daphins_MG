<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSportsmonkFixturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sportsmonk_fixtures', function (Blueprint $table) {
            $table->id();
            $table->string('fixture_id')->nullable();
            $table->string('league_id')->nullable();
            $table->string('league_name')->nullable();
            $table->string('league_type')->nullable();
            $table->string('league_logo')->nullable();
            $table->string('season_id')->nullable();
            $table->string('stage_id')->nullable();
            $table->string('round_id')->nullable();
            $table->string('group_id')->nullable();
            $table->string('aggregate_id')->nullable();
            $table->string('venue_id')->nullable();
            $table->string('referee_id')->nullable();
            $table->string('localteam_id')->nullable();
            $table->json('localteam_data')->nullable();
            $table->string('visitorteam_id')->nullable();
            $table->json('visitorteam_data')->nullable();
            $table->string('winner_team_id')->nullable();
            $table->json('weather_report')->nullable();
            $table->string('commentaries')->nullable();
            $table->string('attendance')->nullable();
            $table->string('pitch')->nullable();
            $table->string('details')->nullable();
            $table->string('neutral_venue')->nullable();
            $table->string('winning_odds_calculated')->nullable();
            $table->json('formations')->nullable();
            $table->json('scores')->nullable();
            $table->json('coaches')->nullable();
            $table->json('standings')->nullable();
            $table->json('assistants')->nullable();
            $table->string('leg')->nullable();
            $table->json('colors')->nullable();
            $table->string('deleted')->nullable();
            $table->string('status')->nullable();
            $table->string('starting_date_time')->nullable();
            $table->string('starting_date')->nullable();
            $table->string('starting_time')->nullable();
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
        Schema::dropIfExists('sportsmonk_fixtures');
    }
}
