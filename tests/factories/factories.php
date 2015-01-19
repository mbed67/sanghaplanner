<?php

$factory('Sanghaplanner\Users\User', [
    'email' => $faker->email,
    'password' => $faker->word,
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

// $factory('Sanghaplanner\Pivot\SanghaUser', [
//     'sangha_id' => 'factory:Sanghaplanner\Sanghas\Sangha',
//     'user_id' => 'factory:Sanghaplanner\Users\User',
//     'role_id' => 'factory:Sanghaplanner\Roles\Role',
//     'created_at' => $faker->dateTime($max = 'now'),
//     'updated_at' => $faker->dateTime($max = 'now')
// ]);

$factory('Sanghaplanner\Sanghas\Sangha', [
    'sanghaname' => 'Mijn sangha',
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
	'subject' => $faker->word,
	'body'	=> $faker->text,
	'is_read' => false,
	'sent_at' => $faker->dateTime($max = 'now'),
	'created_at' => $faker->dateTime($max = 'now'),
	'updated_at' => $faker->dateTime($max = 'now')
	]);
