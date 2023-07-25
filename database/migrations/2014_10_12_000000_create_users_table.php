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
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('phone')->unique();
            $table->string('otp')->nullable();
            $table->enum('user_type', ['Admin', 'User'])->default('Admin');
            $table->boolean('email_verified')->default(false);
            $table->boolean('otp_verified')->default(false);
            $table->string('tokens')->nullable();
            $table->unsignedBigInteger('address_id')->nullable();
            $table->boolean('is_deleted')->default(false);

            // Add the new columns for country, state, and city IDs
            $table->unsignedBigInteger('country_id')->nullable();
            $table->unsignedBigInteger('state_id')->nullable();
            $table->unsignedBigInteger('city_id')->nullable();

            $table->timestamps();
            $table->softDeletes();
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
