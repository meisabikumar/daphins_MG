<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoanuzRecentTournamentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roanuz_recent_tournaments', function (Blueprint $table) {
            $table->id();
            $table->string('tournament_key')->nullable();
            $table->string('tournament_name')->nullable();
            $table->string('tournament_short_name')->nullable();

            $table->string('competition_key')->nullable();
            $table->string('competition_name')->nullable();
            $table->string('competition_short_name')->nullable();

            $table->string('start_date')->nullable();
            $table->string('end_date')->nullable();
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
        Schema::dropIfExists('roanuz_recent_tournaments');
    }
}
