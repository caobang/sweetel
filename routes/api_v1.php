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


Route::middleware('auth:api')->get('/usermenus', 'MenuController@getMenus');

Route::middleware('auth:api')->get('/userinfo', 'UserController@getUserInfo');

Route::middleware('auth:api')->patch('/userstatus', 'UserController@updateUserStatus');

Route::middleware('auth:api')->get('/usergroups', 'GroupController@getUserGroups');

Route::middleware('auth:api')->post('/usergroups', 'GroupController@addUserGroup');

Route::middleware('auth:api')->put('/usergroups/{id}', 'GroupController@editUserGroup')->where('id', '[0-9]+');

Route::middleware('auth:api')->delete('/usergroups/{id}', 'GroupController@delUserGroup')->where('id', '[0-9]+');

Route::middleware('auth:api')->get('/roles', 'RoleController@getRoles');

Route::middleware('auth:api')->post('/roles', 'RoleController@addRole');

Route::middleware('auth:api')->put('/roles/{id}', 'RoleController@editRole')->where('id', '[0-9]+');

Route::middleware('auth:api')->delete('/roles/{id}', 'RoleController@delRole')->where('id', '[0-9]+');

Route::middleware('auth:api')->get('/users', 'UserController@getPagingUsers');

Route::middleware('auth:api')->post('/users', 'UserController@addUser');

Route::middleware('auth:api')->put('/users/{id}', 'UserController@editUser')->where('id', '[0-9]+');

Route::middleware('auth:api')->delete('/users/{id}', 'UserController@delUser')->where('id', '[0-9]+');

Route::middleware('auth:api')->get('/test', function (Request $request) {
    return $request->user();
});