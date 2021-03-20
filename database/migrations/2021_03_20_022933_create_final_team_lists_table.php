<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinalTeamListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('final_team_lists', function (Blueprint $table) {
            $table->id();
            $table->string('team_key')->nullable();
            $table->string('team_name')->nullable();
            $table->string('team_short_name')->nullable();
            $table->string('logo_path')->nullable();
            $table->json('players')->nullable();
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
        Schema::dropIfExists('final_team_lists');
    }
}
