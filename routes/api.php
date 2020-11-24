<?php

use Illuminate\Support\Facades\Route;

Route::resource('users', 'UserController');
Route::post('login', 'LoginController@postLogin');
Route::get('/logout', 'LoginController@logout');
