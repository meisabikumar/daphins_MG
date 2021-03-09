<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Players extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('players', function (Blueprint $table) {
            $table->increments('id');
            $table->string('player_id',50)->nullable();
            $table->string('team_id',50)->nullable();
            $table->string('country_id',50)->nullable();
            $table->string('position_id',50)->nullable();
            $table->string('common_name',200)->nullable();
            $table->string('display_name',50)->nullable();
            $table->string('fullname',200)->nullable();
            $table->string('firstname',200)->nullable();
            $table->string('lastname',200)->nullable();
            $table->string('nationality',200)->nullable();
            $table->string('birthdate',50)->nullable();
            $table->string('birthcountry',50)->nullable();
            $table->string('birthplace',50)->nullable();
            $table->string('height',50)->nullable();
            $table->string('weight',50)->nullable();
            $table->string('image_path',200)->nullable();
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
        Schema::dropIfExists('players');
    }
}
