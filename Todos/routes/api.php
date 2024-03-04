<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware("auth:sanctum")->group(function(){
    Route::prefix("auth")->group(function(){

        Route::post("logout", "Auth\AuthController@logout");
        Route::post("signup", "Auth\AuthController@register");
        Route::post("login", "Auth\AuthController@login");
        Route::post("reset-password", "Auth\AuthController@resetPassword");
        Route::post("forgot-password", "Auth\AuthController@forgotPassword");
    });

});
