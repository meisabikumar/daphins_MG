<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSportsmonkMatchsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sportsmonk_matchs', function (Blueprint $table) {
            $table->id();
            $table->string('fixture_id')->nullable();
            $table->string('match_key')->nullable();
            $table->string('match_away_team')->nullable();
            $table->string('match_home_team')->nullable();
            $table->string('match_name')->nullable();
            $table->string('match_short_name')->nullable();
            $table->string('match_start_date_time')->nullable();
            $table->string('match_start_date')->nullable();
            $table->string('match_start_time')->nullable();
            $table->string('match_status')->nullable();
            $table->string('match_result')->nullable();

            $table->string('league_id')->nullable();
            $table->string('tournament_key')->nullable();
            $table->string('tournament_name')->nullable();
            $table->string('tournament_logo')->nullable();
            $table->string('tournament_type')->nullable();
            $table->string('season_id')->nullable();
            $table->string('stage_id')->nullable();
            $table->string('round_key')->nullable();
            $table->string('group_id')->nullable();

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
        Schema::dropIfExists('sportsmonk_matchs');
    }
}
