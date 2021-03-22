<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCricketFixturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cricket_fixtures', function (Blueprint $table) {
            $table->id();
            $table->string('fixture_id')->nullable();
            $table->string('league_id')->nullable();
            $table->string('season_id')->nullable();
            $table->string('stage_id')->nullable();
            $table->string('round')->nullable();
            $table->string('localteam_id')->nullable();
            $table->string('visitorteam_id')->nullable();
            $table->string('starting_at')->nullable();
            $table->string('type')->nullable();
            $table->string('live')->nullable();
            $table->string('status')->nullable();
            $table->string('last_period')->nullable();
            $table->string('note')->nullable();
            $table->string('venue_id')->nullable();
            $table->string('toss_won_team_id')->nullable();
            $table->string('winner_team_id')->nullable();
            $table->string('draw_noresult')->nullable();
            $table->string('man_of_match_id')->nullable();
            $table->string('man_of_series_id')->nullable();
            $table->string('total_overs_played')->nullable();
            $table->string('elected')->nullable();
            $table->string('super_over')->nullable();
            $table->string('follow_on')->nullable();
            $table->json('localteam_dl_data')->nullable();
            $table->json('visitorteam_dl_data')->nullable();
            $table->string('rpc_overs')->nullable();
            $table->string('rpc_target')->nullable();
            $table->json('weather_report')->nullable();
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
        Schema::dropIfExists('cricket_fixtures');
    }
}
