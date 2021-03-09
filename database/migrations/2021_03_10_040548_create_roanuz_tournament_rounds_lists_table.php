<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoanuzTournamentRoundsListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roanuz_tournament_rounds_lists', function (Blueprint $table) {
            $table->id();
            $table->string('round_key')->nullable();
            // $table->string('groups')->nullable();
            $table->string('round_name')->nullable();
            $table->json('teams')->nullable();

            $table->string('tournament_key')->nullable();
            $table->string('tournament_name')->nullable();
            $table->string('tournament_short_name')->nullable();
            $table->string('tournament_start_date')->nullable();
            $table->string('tournament_end_date')->nullable();
            $table->string('competition_key')->nullable();

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
        Schema::dropIfExists('roanuz_tournament_rounds_lists');
    }
}
