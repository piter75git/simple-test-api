<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Channel;
use App\Models\Programme;
use App\Http\Responses\Response;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProgrammeTest extends TestCase
{
    /**
     * Test if can get the channel's programme.
     *
     * @return void
     */
    public function testCanGetChannelProgramme()
    {
        $programme = Programme::all()->random();

        $channel = Channel::find($programme->channel_id);

        $response = $this->json('GET', '/channels/' . $channel->uuid . '/programmes/' . $programme->uuid)
            ->assertStatus(Response::HTTP_OK);
    }

    /**
     * Test if can not get the programme with invalid channel uuid.
     *
     * @return void
     */
    public function testCanNotGetProgrammeWithInvalidChannelUuid()
    {
        $programme = Programme::all()->random();

        $channel_uuid = time();

        $response = $this->json('GET', '/channels/' . $channel_uuid . '/programmes/' . $programme->uuid)
            ->assertStatus(Response::HTTP_NOT_FOUND);
    }

    /**
     * Test if can not get the programme with invalid programme uuid.
     *
     * @return void
     */
    public function testCanNotGetProgrammeWithInvalidProgrammeUuid()
    {
        $programme = Programme::all()->random();

        $programme_uuid = time();

        $channel = Channel::find($programme->channel_id);

        $response = $this->json('GET', '/channels/' . $channel->uuid . '/programmes/' . $programme_uuid)
            ->assertStatus(Response::HTTP_NOT_FOUND);
    }
}
