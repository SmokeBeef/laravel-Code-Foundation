<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Resepsionis\ItemController as ItemControllerResepsionis ;
use App\Http\Controllers\ItemController;
use Illuminate\Support\Facades\Route;
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
    Route::post("/", [AuthController::class, "register"]);
    Route::post("/login", [AuthController::class, "login"]);

    // queue job 
    Route::post("/many", [UserController::class, "createManyAuto"]); // for create many users

    Route::middleware([JwtMiddleware::class])->group(function () {
        Route::get("/", [UserController::class, "getAll"]);
        Route::delete("/logout", [AuthController::class, "logout"]);
        Route::get("/refreshToken", [UserController::class, "refreshToken"]);
    });
});

Route::prefix("item")->group(function () {
    Route::get("/", [ItemController::class,"getAllPaginate"]);
    
    // resepsionis only
    Route::post("/", [ItemControllerResepsionis::class,"create"]);
});