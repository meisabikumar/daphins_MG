<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCricketContestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cricket_contests', function (Blueprint $table) {
            $table->id();
            $table->string('match_id')->nullable();
            $table->string('contest_name')->nullable();
            $table->string('game_type')->nullable();
            $table->string('category')->nullable();
            $table->string('tagline')->nullable();
            $table->string('start_date')->nullable();
            $table->integer('max_remaining_entry')->nullable();
            $table->integer('entry_per_user')->nullable();
            $table->integer('entry_fee')->nullable();
            $table->integer('min_entry')->nullable();
            $table->integer('max_entry')->nullable();
            $table->float('admin_per')->nullable();
            $table->float('admin_amt')->nullable();
            $table->float('winning_amt')->nullable();
            $table->boolean('is_free')->nullable();
            $table->boolean('is_featured')->nullable();
            $table->string('game_status')->nullable();
            $table->boolean('is_confirmed')->nullable();
            $table->boolean('is_cancelled')->nullable();
            $table->json('breakdown')->nullable();
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
        Schema::dropIfExists('cricket_contests');
    }
}
