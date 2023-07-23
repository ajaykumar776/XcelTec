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
            $table->boolean('email_verified')->default(false); // Add the 'email_verified' column
            $table->boolean('otp_verified')->default(false);   // Add the 'otp_verified' column
            $table->string('tokens')->nullable();
            $table->unsignedBigInteger('address_id')->nullable();
            $table->boolean('is_deleted')->default(false);
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
