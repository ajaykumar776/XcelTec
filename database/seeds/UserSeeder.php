<?php

use App\User;
use App\UserModel;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {

            $dummyData = [];
            for ($i = 1; $i <= 50; $i++) {
                $dummyData[] = [
                    'first_name' => $this->generateRandomName(),
                    'last_name' => $this->generateRandomName(),
                    'email' => $this->generateRandomEmail(),
                    'password' => bcrypt(rand(1, 10)),
                    'phone' => $this->generateRandomIndianPhoneNumber(),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ];
            }
            User::insert($dummyData);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
    /**
     * Generate a random name of length 5.
     *
     * @return string
     */
    private function generateRandomName()
    {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        $name = '';

        for ($i = 0; $i < 5; $i++) {
            $name .= $characters[rand(0, strlen($characters) - 1)];
        }

        return $name;
    }
    private function generateRandomIndianPhoneNumber()
    {
        $prefix = '789'; // Starting digit for Indian mobile numbers
        $randomNumber = mt_rand(100000000, 999999999); // Generate 9 random digits

        return $prefix . $randomNumber;
    }
    private function generateRandomEmail()
    {
        $username = $this->generateRandomName(); // You can adjust the length as needed
        $domain = 'example.com'; // Change the domain if needed
        $email = $username . '@' . $domain;

        return $email;
    }
}
