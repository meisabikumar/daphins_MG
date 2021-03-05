<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoanuzTeamPlayersDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roanuz_team_players_details', function (Blueprint $table) {
            $table->id();
            $table->string('team_key')->nullable();
            // $table->string('team_code')->nullable();
            // $table->string('team_name')->nullable();
            $table->string('player_key')->nullable();
            $table->string('player_name')->nullable();
            $table->string('player_role')->nullable();
            $table->string('jersey_number')->nullable();
            $table->string('jersey_name')->nullable();
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
        Schema::dropIfExists('roanuz_team_players_details');
    }
}
