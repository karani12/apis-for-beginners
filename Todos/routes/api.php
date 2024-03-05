<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\TodoController;
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

Route::prefix("auth")->group(function(){

    Route::post("logout", AuthController::class . "@logout")->middleware("auth:sanctum");
    Route::post("signup", AuthController::class . "@register");
    Route::post("login", AuthController::class . "@login")->name("login");
    Route::post("reset-password", AuthController::class . "@resetPassword");
    Route::post("forgot-password", AuthController::class . "@forgotPassword");
});

Route::middleware('auth:sanctum')->group(function(){
    Route::apiResource("todos", TodoController::class);
});


