<?php

use App\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    const INDIAN_MOBILE_PREFIX = '789';
    const DOMAIN = 'example.com';
    const NAME_LENGTH = 5;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        try {
            $dummyData = [];
            for ($i = 1; $i <= 50; $i++) {
                $dummyData[] = [
                    'first_name' => $faker->name,
                    'last_name' => $faker->name,
                    'email' => $faker->unique()->safeEmail,
                    'password' => bcrypt($faker->randomDigit),
                    'phone' => $this->generateRandomIndianPhoneNumber(),
                    'created_at' => $faker->dateTimeThisDecade()->format('Y-m-d H:i:s'),
                    'updated_at' => $faker->dateTimeThisDecade()->format('Y-m-d H:i:s'),
                ];
            }
            User::insert($dummyData);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    /**
     * Generate a random Indian phone number.
     *
     * @return string
     */
    private function generateRandomIndianPhoneNumber()
    {
        $randomNumber = mt_rand(100000000, 999999999);

        return self::INDIAN_MOBILE_PREFIX . $randomNumber;
    }
}
