<?php

declare(strict_types = 1);

namespace App\Http\Controllers;

use App\Models\Channel;
use App\Http\Requests\Request;
use App\Http\Responses\Response;
use App\Http\Controllers\Controller;

class ChannelController extends Controller
{
    /**
     * Display a listing of the channels.
     *
     * @param  \App\Http\Requests\Reques  $request
     * @return App\Http\Responses\Response
     */
    public function index(Request $request): Response
    {
        $channels = Channel::select(['id', 'uuid', 'name', 'icon'])
            ->orderBy('id')
            ->get();

        return new Response(compact('channels'));
    }
}
