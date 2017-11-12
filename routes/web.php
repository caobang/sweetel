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

Route::prefix('api/v1')->group(function () {
    Route::get('/menus', 'ApiController@getmenus');
    Route::get('/userinfo', 'ApiController@getuserinfo');

});

Route::prefix('wapi')->group(function () {
    Route::get('/config', 'WidgetController@getconfig');

});