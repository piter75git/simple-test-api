<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Channel;

use App\Models\Channel;
use App\Models\Timezone;
use App\Models\Programme;
use App\Rules\TimezoneRule;
use App\Http\Requests\Request;
use App\Http\Responses\Response;
use App\Http\Controllers\Controller;

class TimetableController extends Controller
{
    /**
     * Display a timetable of the channel programmes.
     *
     * @param  \App\Http\Requests\Request  $request
     * @param  string  $channel_uuid
     * @param  string  $date
     * @param  string  $timezone
     * @return \App\Http\Responses\Response
     */
    public function index(Request $request, string $channel_uuid, string $date, string $timezone): Response
    {
        $request->merge(compact('date', 'timezone'))
            ->validate($this->getIndexValidationRules());

        $channel = Channel::select(['id'])
            ->where('uuid', $channel_uuid)
            ->firstOrFail();

        Timezone::setDateTimeZone($timezone);

        $datetime = Timezone::createDateTime($date);

        $programmes = Programme::select(['id', 'uuid', 'name', 'start', 'end', 'duration'])
            ->where('channel_id', $channel->id)
            ->whereRaw(
                'DATE(DATE_ADD(start, INTERVAL ? SECOND)) = ?',
                [$datetime->getOffset(), $datetime->format('Y-m-d')]
            )
            ->orderBy('start')
            ->get();

        return new Response(compact('programmes'));
    }

    /**
     * Get the validation rules that apply to the index request.
     *
     * @return array
     */
    private function getIndexValidationRules(): array
    {
        return [
            'date' => ['date'],
            'timezone' => [new TimezoneRule()]
        ];
    }
}
