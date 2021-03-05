<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Teams extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->increments('id');
            $table->string('teamId',50)->nullable();
            $table->string('legacy_id',50)->nullable();
            $table->string('name',100)->nullable();
            $table->string('short_code',50)->nullable();
            $table->string('twitter',50)->nullable();
            $table->string('country_id',50)->nullable();
            $table->string('national_team',50)->nullable();
            $table->string('founded',50)->nullable();
            $table->string('logo_path',200)->nullable();
            $table->string('venue_id',50)->nullable();
            $table->string('current_season_id',50)->nullable();
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
        Schema::dropIfExists('teams');
    }
}
