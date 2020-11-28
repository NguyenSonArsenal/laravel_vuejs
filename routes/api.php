<?php

use Illuminate\Support\Facades\Route;

Route::resource('users', 'UserController');
Route::post('login', 'LoginController@postLogin')->withoutMiddleware(['api']);
Route::get('/logout', 'LoginController@logout');
Route::get('/test', 'DashboardController@index');
