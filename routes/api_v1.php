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


Route::middleware('auth:api')->get('/usermenus', 'WebApiController@getMenus');

Route::middleware('auth:api')->get('/userinfo', 'WebApiController@getUserInfo');

Route::middleware('auth:api')->patch('/userstatus', 'WebApiController@updateUserStatus');

Route::middleware('auth:api')->get('/usergroups', 'WebApiController@getUserGroups');

Route::middleware('auth:api')->post('/usergroups', 'WebApiController@addUserGroup');

Route::middleware('auth:api')->put('/usergroups/{id}', 'WebApiController@editUserGroup')->where('id', '[0-9]+');

Route::middleware('auth:api')->delete('/usergroups/{id}', 'WebApiController@delUserGroup')->where('id', '[0-9]+');

Route::middleware('auth:api')->get('/users', 'WebApiController@getPagingUsers');

Route::middleware('auth:api')->post('/users', 'WebApiController@addUser');

Route::middleware('auth:api')->put('/users/{id}', 'WebApiController@editUser')->where('id', '[0-9]+');

Route::middleware('auth:api')->delete('/users/{id}', 'WebApiController@delUser')->where('id', '[0-9]+');

Route::middleware('auth:api')->get('/test', function (Request $request) {
    return $request->user();
});