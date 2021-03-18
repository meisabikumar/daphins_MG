<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinalMatchListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('final_match_lists', function (Blueprint $table) {
            $table->id();

            $table->string('match_key')->nullable();
            $table->string('match_away_team')->nullable();
            $table->string('match_home_team')->nullable();
            $table->string('match_name')->nullable();
            $table->string('match_short_name')->nullable();
            $table->string('match_start_date')->nullable();
            $table->string('match_start_time')->nullable();
            $table->string('API')->nullable();

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
        Schema::dropIfExists('final_match_lists');
    }
}
