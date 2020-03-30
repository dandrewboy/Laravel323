<?php

use App\Http\Controllers\LoginController;

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
    return view('index1');
});
    Route::get('Login', function () {
        return view('Login');
    });
    

Route::post('/doLogin', 'LoginController@index');
Route::post('/doLogin2', 'LoginController2@index');
Route::post('/doLogin3', 'LoginController3@index');
Route::post('/doVal', 'ValidationController@validation');
Route::resource('/usersrest', 'UserRestController');
Route::get('/loggingservice', 'TestLoggerController@index');