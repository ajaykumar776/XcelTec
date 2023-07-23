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
        for ($i = 1; $i <= 5; $i++) {
            User::create([
                'name' => 'Admin User ' . $i,
                'email' => 'admin' . $i . '@example.com',
                'password' => Hash::make('123456'), // Hash the password using the Hash facade
                'phone' => 7781031768 + $i, // Increment the phone number for each user
                'user_type' => 'Admin',
                'email_verified' => true,
                'otp_verified' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Create 5 Regular users
        for ($i = 1; $i <= 5; $i++) {
            User::create([
                'name' => 'Regular User ' . $i,
                'email' => 'user' . $i . '@example.com',
                'password' => Hash::make('123456'),
                'phone' => 7781031768 + $i,
                'user_type' => 'User',
                'email_verified' => true,
                'otp_verified' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
