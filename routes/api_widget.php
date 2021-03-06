<?php

/*
|--------------------------------------------------------------------------
| WebWidget Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/configs/{tid}', 'WidgetController@getConfig');

Route::post('/connection', 'WidgetController@connection');

Route::post('/messages', 'WidgetController@sendMessage');
