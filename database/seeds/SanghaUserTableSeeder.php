<?php

use Illuminate\Database\Seeder;
use Sanghaplanner\Users\User;
use Sanghaplanner\Sanghas\Sangha;
use Sanghaplanner\Roles\Role;

class SanghaUserTableSeeder extends Seeder
{

    public function run()
    {
        $faker = Faker\Factory::create();

        $userIds = User::lists('id');
        $sanghaIds = Sangha::lists('id');
        $roleIds = Role::lists('id');

        foreach (range(1, 30) as $index) {
            DB::table('sangha_user')->insert([
                'sangha_id' => $faker->randomElement($sanghaIds),
                'user_id' => $faker->randomElement($userIds),
                'role_id' => $faker->randomElement($roleIds),
                'created_at' => $faker->dateTime($max = 'now'),
                'updated_at' => $faker->dateTime($max = 'now')
            ]);
        }
    }
}
