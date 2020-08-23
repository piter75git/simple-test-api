<?php

declare(strict_types = 1);

namespace App\Http\Controllers;

use App\Models\Endpoint;
use App\Http\Requests\Request;
use App\Http\Responses\Response;
use App\Http\Controllers\Controller;

class InfoController extends Controller
{
    /**
     * Display an info about the API.
     *
     * @param  \App\Http\Requests\Request  $request
     * @return \App\Http\Responses\Response
     */
    public function index(Request $request): Response
    {
        $name = config('app.name');

        $endpoints = Endpoint::select(['url', 'description'])
            ->orderBy('id')
            ->get();

        return new Response(compact('name', 'endpoints'));
    }
}
