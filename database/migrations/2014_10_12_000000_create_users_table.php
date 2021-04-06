<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('email')->unique()->nullable();
            // $table->timestamp('email_verified_at')->nullable();
            // $table->string('password');
            $table->string('mobile')->unique();
            $table->bigInteger('otp')->nullable();
            $table->string('profile_pic')->nullable();

            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->string('address')->nullable();
            $table->string('gender')->nullable();
            $table->string('DOB')->nullable();
            $table->float('wallet', 5, 2)->nullable();
            $table->softDeletes('deleted_at');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
