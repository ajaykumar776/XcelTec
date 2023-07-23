<?php

use Illuminate\Database\Seeder;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'SuperAdmin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123456'), // Hash the password using the Hash facade
            'phone' => 7781031768, // Increment the phone number for each user
            'user_type' => 'Admin',
            'email_verified' => true,
            'otp_verified' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
