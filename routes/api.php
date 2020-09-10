<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
 
Route::post('/register', 'App\Http\Controllers\Api\AuthController@register');
Route::post('/login', 'App\Http\Controllers\Api\AuthController@login');

Route::apiResource('/sector', 'App\Http\Controllers\Api\SectorController')->middleware('auth:api');
Route::apiResource('/product', 'App\Http\Controllers\Api\ProductController')->middleware('auth:api');