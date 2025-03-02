<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoanuzMatchTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roanuz_match_teams', function (Blueprint $table) {
            $table->id();
            $table->string('match_key')->nullable();
            $table->string('team_key')->nullable();
            $table->string('team_name')->nullable();
            $table->string('team_short_name')->nullable();
            $table->json('players')->nullable();

            $table->string('tournament_key')->nullable();
            $table->string('tournament_name')->nullable();
            $table->string('tournament_short_name')->nullable();
            $table->string('tournament_legal_name')->nullable();
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
        Schema::dropIfExists('roanuz_match_teams');
    }
}
