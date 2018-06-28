<?php

/*
|--------------------------------------------------------------------------
| User Factory
|--------------------------------------------------------------------------
|
| Here you may define the User factory. Factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how the User model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\User::class, function ($faker) {
	static $password;

	return [
		'name' => $faker->name,
		'email' => $faker->unique()->safeEmail,
		'password' => $password ?: $password = bcrypt('secret'),
		'remember_token' => str_random(10),
        'user_type_id' => 2
	];
});
