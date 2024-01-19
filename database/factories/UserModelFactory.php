<?php

use Illuminate\Database\Eloquent\Factories\Factory;
use App\UserModel;

class UserModelFactory extends Factory
{
    protected $model = UserModel::class;

    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'email' => $this->faker->unique()->safeEmail,
            'password' => bcrypt('password'), // You can change 'password' to the desired default password
            'phone' => $this->faker->phoneNumber,
            // Add other fields as needed...
        ];
    }
}
