<?php

use Illuminate\Database\Seeder;
use Sanghaplanner\Users\User;

class UsersTableSeeder extends Seeder
{

    public function run()
    {
        $faker = Faker\Factory::create();

        foreach (range(1, 30) as $index) {
            User::create([
            'email' => $faker->email,
            'password' => bcrypt('geheim'),
            'firstname' => $faker->firstName(),
            'middlename' => $faker->firstName(),
            'lastname' => $faker->lastName,
            'address' => $faker->streetAddress,
            'zipcode' => $faker->postcode,
            'place' => $faker->city,
            'phone' => $faker->phoneNumber,
            'gsm' => $faker->phoneNumber,
            'created_at' => $faker->dateTime($max = 'now'),
            'updated_at' => $faker->dateTime($max = 'now')
            ]);
        }
    }
}
