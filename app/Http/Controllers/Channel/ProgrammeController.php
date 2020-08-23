<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Channel;

use App\Models\Programme;
use App\Http\Requests\Request;
use App\Http\Responses\Response;
use App\Http\Controllers\Controller;

class ProgrammeController extends Controller
{
    /**
     * Display the specified channel programme.
     *
     * @param  \App\Http\Requests\Request $request
     * @param  string  $channel_uuid
     * @param  string  $programme_uuid
     * @return \App\Http\Responses\Response
     */
    public function show(Request $request, string $channel_uuid, string $programme_uuid): Response
    {
        $programme = Programme::select(['id', 'uuid', 'name', 'description', 'thumbnail', 'start', 'end', 'duration', 'channel_id'])
            ->with(['channel'])
            ->where('uuid', $programme_uuid)
            ->whereHas('channel', function ($query) use ($channel_uuid) {
                $query->where('uuid', $channel_uuid);
            })
            ->firstOrFail()
            ->makeHidden(['channel_id']);

        return new Response(compact('programme'));
    }
}
