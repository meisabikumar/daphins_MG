<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFootballContestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('football_contests', function (Blueprint $table) {
            $table->id();
            $table->string('match_id')->nullable();
            $table->string('contest_name')->nullable();
            $table->string('contest_category')->nullable();
            $table->string('game_type')->nullable();
            $table->string('entry_fee')->nullable();
            $table->string('entry_per_user')->nullable();
            $table->string('min_entry')->nullable();
            $table->string('max_entry')->nullable();
            $table->string('breakdown_amt')->nullable();
            $table->string('is_free')->nullable();
            $table->string('winning_amt')->nullable();
            $table->string('is_featured')->nullable();
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
        Schema::dropIfExists('football_contests');
    }
}
