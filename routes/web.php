<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home/{module?}', 'HomeController@index')->name('home');

Route::get('/chat/pc', function () {
    return view('chat.pc');
});

Route::get('/chat/mobile', function () {
    return view('chat.mobile');
});
