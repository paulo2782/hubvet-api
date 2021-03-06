<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
 
Route::post('/register', 'App\Http\Controllers\Api\AuthController@register');
Route::post('/login', 'App\Http\Controllers\Api\AuthController@login');

Route::middleware(['auth:api'])->group(function () {
	Route::apiResource('/sector', 'App\Http\Controllers\Api\SectorController');
	Route::apiResource('/product', 'App\Http\Controllers\Api\ProductController');
});