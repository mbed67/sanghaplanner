<?php

$factory('Sanghaplanner\Users\User', [
    'email' => $faker->email,
    'password' => bcrypt('foofoofoo'),
    'firstname' => $faker->word,
    'middlename' => $faker->word,
    'lastname' => $faker->word,
    'address' => $faker->word,
    'zipcode' => $faker->word,
    'place' => $faker->word,
    'phone' => $faker->word,
    'gsm' => $faker->word,
    'created_at' => $faker->dateTime($max = 'now'),
    'updated_at' => $faker->dateTime($max = 'now')
]);

$factory('Sanghaplanner\Sanghas\Sangha', [
    'sanghaname' => 'Mijn sangha',
    'address' => $faker->streetAddress,
    'zipcode' => $faker->postcode,
    'place' => $faker->city,
    'filename' => $faker->word,
    'thumbnailName' => $faker->word,
    'created_at' => $faker->dateTime($max = 'now'),
    'updated_at' => $faker->dateTime($max = 'now')
]);

$factory('Sanghaplanner\Roles\Role', [
    'rolename' => $faker->word,
    'created_at' => $faker->dateTime($max = 'now'),
    'updated_at' => $faker->dateTime($max = 'now')
]);

$factory('Sanghaplanner\Notifications\Notification', [
    'user_id' => 'factory:Sanghaplanner\Users\User',
    'sender_id' => 'factory:Sanghaplanner\Users\User',
    'type' => 'MembershipRequest',
    'subject' => $faker->word,
    'body'  => 'Mijn sangha',
    'object_id' => 'factory:Sanghaplanner\Sanghas\Sangha',
    'object_type' => 'Sanghaplanner\Sanghas\Sangha',
    'is_read' => 0,
    'created_at' => $faker->dateTime($max = 'now'),
    'updated_at' => $faker->dateTime($max = 'now')
    ]);
