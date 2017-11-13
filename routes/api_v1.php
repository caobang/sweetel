<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| WebAPI V1 Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::middleware('auth:api')->get('/usermenus', 'WebApiController@getmenus');

Route::middleware('auth:api')->get('/userinfo', 'WebApiController@getuserinfo');

Route::middleware('auth:api')->patch('/userstatus', 'WebApiController@updateuserstatus');

Route::middleware('auth:api')->get('/test', function (Request $request) {
    return $request->user();
});