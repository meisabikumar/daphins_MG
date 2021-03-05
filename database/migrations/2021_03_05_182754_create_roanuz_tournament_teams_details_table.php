<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoanuzTournamentTeamsDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roanuz_tournament_teams_details', function (Blueprint $table) {
            $table->id();
            $table->string('tournament_key')->nullable();
            $table->string('tournament_name')->nullable();
            $table->string('team_key')->nullable();
            $table->string('team_code')->nullable();
            $table->string('team_name')->nullable();

            // $table->string('short_name')->nullable();
            // $table->string('start_date')->nullable();
            // $table->string('end_date')->nullable();
            // $table->string('competition_key')->nullable();

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
        Schema::dropIfExists('roanuz_tournament_teams_details');
    }
}
