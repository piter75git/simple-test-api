<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('channels', 'ChannelController@index');
Route::get('channels/{channel_uuid}/programmes/{programme_uuid}', 'Channel\ProgrammeController@show');
Route::get('channels/{channel_uuid}/{date}/{timezone}', 'Channel\TimetableController@index');

Route::get('/', 'InfoController@index');
