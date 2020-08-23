<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Http\Responses\Response;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ChannelTest extends TestCase
{
    /**
     * Test if can get the list of channels.
     *
     * @return void
     */
    public function testCanGetListOfChannels()
    {
        $response = $this->json('GET', '/channels')
            ->assertStatus(200);
    }
}
