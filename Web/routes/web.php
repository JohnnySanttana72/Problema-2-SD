<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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




/* Rota para Index */
Route::get('/', 'IndexController@index');

Route::post('/publishMqtt', 'IndexController@publishMqtt');

Route::post('/republishMqtt', 'IndexController@republishMqtt');

Route::post('/subscribeMqtt', 'IndexController@subscribeMqtt');


