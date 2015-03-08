<?php

use Illuminate\Database\Seeder;
use Sanghaplanner\Roles\Role;

class RolesTableSeeder extends Seeder
{

    public function run()
    {
        $faker = Faker\Factory::create();

        Role::create([
        'rolename' => 'administrator',
        'created_at' => $faker->dateTime($max = 'now'),
        'updated_at' => $faker->dateTime($max = 'now')
        ]);

        Role::create([
        'rolename' => 'lid',
        'created_at' => $faker->dateTime($max = 'now'),
        'updated_at' => $faker->dateTime($max = 'now')
        ]);

    }
}
