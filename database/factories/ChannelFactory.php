<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Channel;
use Faker\Generator as Faker;

$factory->define(Channel::class, function (Faker $faker) {
    $path = public_path(Channel::STORAGE);

    return [
        'uuid' => $faker->uuid,
        'name' => $faker->colorName,
        'icon' => $faker->image($path, 64, 64, null, false) // 1:1
    ];
});
