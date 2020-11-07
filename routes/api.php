<?php

use Illuminate\Support\Facades\Route;

Route::resource('students', 'Api\StudentController');
Route::resource('users', 'Api\UserController');
