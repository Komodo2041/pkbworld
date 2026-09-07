<?php

use Illuminate\Support\Facades\Route;

Route::get('/', "App\Http\Controllers\MainController@main");
Route::get('/import', "App\Http\Controllers\MainController@import");
Route::get('/calc', "App\Http\Controllers\MainController@calc");
