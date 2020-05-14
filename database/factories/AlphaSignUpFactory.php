<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\AlphaSignUp;
use App\User;
use Faker\Generator as Faker;

$factory->define(AlphaSignUp::class, function (Faker $faker) {
    return [
        'user_id' => $faker->boolean ? factory(User::class) : null,
        'email' => $faker->safeEmail,
        'user_agent' => $faker->userAgent,
        'ip_address' => $faker->ipv4
    ];
});
