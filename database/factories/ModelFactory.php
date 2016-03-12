<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

use PetNecro\User;

$factory->define(PetNecro\User::class, function (Faker\Generator $faker) {
    $faker->seed($faker->numberBetween(0, 2000));

    return [
        'username' => $faker->userName,
        'language' => $faker->languageCode,
        'email' => $faker->email,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(PetNecro\Profile::class, function (Faker\Generator $faker) {
    $user = User::orderBy('id', 'desc')->first();

    $faker->seed($faker->numberBetween(0, 2000));

    return [
        'user_id' => $user->id,
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'address1' => $faker->streetAddress,
        'address2' => null,
        'city' => $faker->city,
        'zip' => $faker->postcode,
        'state' => $faker->stateAbbr,
        'country' => $faker->countryCode,
    ];
});
