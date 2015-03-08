<?php

use Illuminate\Database\Seeder;
use Sanghaplanner\Sanghas\Sangha;

class SanghasTableSeeder extends Seeder
{

    public function run()
    {
        $faker = Faker\Factory::create();

        foreach (range(1, 10) as $index) {
            Sangha::create([
            'sanghaname' => 'Sangha ' . $faker->city,
            'address' => $faker->streetAddress,
            'zipcode' => $faker->postcode,
            'place' => $faker->city,
            'filename' => $faker->word,
            'thumbnailName' => $faker->word,
            'created_at' => $faker->dateTime($max = 'now'),
            'updated_at' => $faker->dateTime($max = 'now')
            ]);
        }
    }
}
