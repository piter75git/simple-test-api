<?php

declare(strict_types = 1);

use App\Models\Endpoint;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class EndpointsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $endpoint = new Endpoint();
        $endpoint->url = '/channels';
        $endpoint->description = 'Get the list of channels';
        $endpoint->save();

        $endpoint = new Endpoint();
        $endpoint->url = '/channels/{channel_uuid}/programmes/{programme_uuid}';
        $endpoint->description = 'Get the programme details based on given channel and programme uuids';
        $endpoint->save();

        $endpoint = new Endpoint();
        $endpoint->url = '/channels/{channel_uuid}/{date}/{timezone}';
        $endpoint->description = 'Get the channel programmes for the date and timezone. Use a timezone in the format {continent-city}.';
        $endpoint->save();
    }
}
