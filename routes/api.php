<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Created a get user route that can be used by the client app
// This has been guarded by the auth:api middleware so that only authorized apps can access 
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');
