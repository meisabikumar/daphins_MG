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
            $table->string('user_role')->nullable();
            $table->string('slug')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->unique()->nullable();
            // $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->string('mobile')->unique();
            $table->bigInteger('otp')->nullable();
            $table->string('profile_pic')->nullable();

            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->string('address')->nullable();
            $table->string('gender')->nullable();
            $table->string('DOB')->nullable();
            $table->string('team_name')->nullable();
            
            $table->string('timezone')->nullable();
            $table->string('is_verified')->nullable();
            $table->string('is_active')->nullable();
            $table->string('is_approved')->nullable();
            $table->string('validate_string')->nullable();
            $table->string('forgot_password_validate_string')->nullable();
            $table->string('post_code')->nullable();
            $table->string('facebook')->nullable();
            $table->string('Google')->nullable();
            $table->string('website')->nullable();
            

            $table->string('is_deleted')->nullable();
            
            $table->string('is_profile_completed')->nullable();
            $table->string('api_token')->nullable();

            $table->string('fb_id')->nullable();
            $table->string('google_id')->nullable();
            $table->string('apple_id')->nullable();
            $table->string('referal_amount')->nullable();
            
            $table->string('is_bot')->nullable();
            $table->string('won_amount')->nullable();
            $table->string('referal_code')->nullable();
            $table->string('referer_code')->nullable();
            $table->string('referal_status')->nullable();

            $table->string('device_id')->nullable();
            $table->string('device_type')->nullable();
            $table->string('notification_status')->nullable();

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
