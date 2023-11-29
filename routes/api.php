<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;
use App\Http\Middleware\JwtMiddleware;

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

Route::prefix("user")->group(function () {
    Route::post("/", [UserController::class,"register"]);
    Route::post("/login", [UserController::class,"login"]);
    // Route::post("/many", [UserController::class,"createManyAuto"]); // for create many users

    Route::middleware([JwtMiddleware::class])->group(function () {
        Route::get("/", [UserController::class,"getAll"]);
        Route::delete("/logout", [UserController::class,"logout"]);
        Route::get("/refreshToken", [UserController::class,"refreshToken"]);
    });
});