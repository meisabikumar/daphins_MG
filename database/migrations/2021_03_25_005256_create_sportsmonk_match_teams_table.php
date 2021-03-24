<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSportsmonkMatchTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sportsmonk_match_teams', function (Blueprint $table) {
            $table->id();
            $table->string('team_id')->nullable();
            $table->string('fixture_id')->nullable();
            $table->string('legacy_id')->nullable();
            $table->string('name')->nullable();
            $table->string('short_code')->nullable();
            $table->string('twitter')->nullable();
            $table->string('country_id')->nullable();
            $table->string('national_team')->nullable();
            $table->string('founded')->nullable();
            $table->string('logo_path')->nullable();
            $table->string('venue_id')->nullable();
            $table->string('current_season_id')->nullable();
            $table->string('is_placeholder')->nullable();
            $table->json('players')->nullable();
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
        Schema::dropIfExists('sportsmonk_match_teams');
    }
}
