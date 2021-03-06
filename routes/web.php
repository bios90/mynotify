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
    return "all ok you are connected";
});

Route::post('/register','RegisterController@register');

Route::post('/login','LoginController');

Route::post('/updatetoken','UpdateTokenController');

Route::get('/validate','ValidationPageController@index');

Route::get('/admin','AdminController@index');

Route::post('/admin','AdminController@send');
