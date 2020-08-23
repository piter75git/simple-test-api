<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Channel;
use App\Models\Programme;
use Faker\Generator as Faker;

$factory->define(Programme::class, function (Faker $faker) {
    $channel = Channel::all()->random();

    // find the latest programme of the channel
    $last_program_of_channel = Programme::select('end')
        ->where('channel_id', $channel->id)
        ->orderBy('end', 'desc')
        ->first();

    $start = $last_program_of_channel
        ? $last_program_of_channel->end->modify('+1 second') // start the next programme immediately after the found one
        : new DateTime('tomorrow noon'); // start tomorrow noon the first programme of the channel

    $end = $faker->dateTimeBetween($start, (clone $start)->modify('+2 hour')); // end the programme within max 2 hours

    $path = public_path(Programme::STORAGE);

    return [
        'channel_id' => $channel->id,
        'start' => $start->format('Y-m-d H:i:s'),
        'end' => $end->format('Y-m-d H:i:s'),
        'uuid' => $faker->uuid,
        'description' => $faker->text,
        'name' => $faker->firstName,
        'thumbnail' => $faker->image($path, 240, 135, null, false) // 16:9
    ];
});
