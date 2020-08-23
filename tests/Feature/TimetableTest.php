<?php

namespace Tests\Feature;

use DateTime;
use Tests\TestCase;
use App\Models\Channel;
use App\Models\Programme;
use App\Http\Responses\Response;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TimetableTest extends TestCase
{
    /**
     * Test if can get the list of channel's programmes.
     *
     * @return void
     */
    public function testCanGetChannelProgrammes()
    {
        $channel = Channel::all()->random();

        $programme = Programme::where('channel_id', $channel->id)
            ->first();

        $date = new DateTime('tomorrow');

        $timezone = 'Europe-London';

        $response = $this->json('GET', '/channels/' . $channel->uuid . '/' . $date->format('Y-m-d') . '/' . $timezone)
            ->assertStatus(Response::HTTP_OK);
    }

    /**
     * Test if can not get the list of programmes with invalid channel uuid.
     *
     * @return void
     */
    public function testCanNotGetProgrammesWithInvalidChannelUuid()
    {
        $channel_uuid = time();

        $date = new DateTime('tomorrow');

        $timezone = 'Europe-London';

        $response = $this->json('GET', '/channels/' . $channel_uuid . '/' . $date->format('Y-m-d') . '/' . $timezone)
            ->assertStatus(Response::HTTP_NOT_FOUND);
    }

    /**
     * Test if can not get the list of programmes with invalid date.
     *
     * @return void
     */
    public function testCanNotGetProgrammesWithInvalidDate()
    {
        $channel = Channel::all()->random();

        $date = new DateTime('tomorrow');

        $timezone = 'Europe-London';

        $response = $this->json('GET', '/channels/' . $channel->uuid . '/' . $date->format('H:i:s') . '/' . $timezone)
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * Test if can not get the list of programmes with invalid timezone.
     *
     * @return void
     */
    public function testCanNotGetProgrammesWithInvalidTimezone()
    {
        $channel = Channel::all()->random();

        $date = new DateTime('tomorrow');

        $timezone = 'Europe-Asia';

        $response = $this->json('GET', '/channels/' . $channel->uuid . '/' . $date->format('Y-m-d') . '/' . $timezone)
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
