<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Resepsionis\ItemController as ItemControllerResepsionis;
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
    Route::post("/register", [AuthController::class, "register"]);
    Route::post("/login", [AuthController::class, "login"]);

    // queue job 
    Route::post("/many", [UserController::class, "createManyAuto"]); // for create many users

    Route::middleware(["jwt"])->group(function () {
        Route::get("/", [UserController::class, "getAll"]);
        Route::get("/refreshToken", [AuthController::class, "refreshToken"]);
        Route::delete("/logout", [AuthController::class, "logout"]);
        Route::delete("/{id}", [UserController::class,"delete"]);
    });
});

Route::group([
    "prefix" => "item",
    "middleware" => ["jwt"],
], function () {

    Route::get("/", [ItemController::class, "getAllPaginate"]);

    // resepsionis only
    Route::post("/", [ItemControllerResepsionis::class, "create"]);
    Route::put("/{id}", [ItemControllerResepsionis::class, "update"]);
    Route::delete("/{id}", [ItemControllerResepsionis::class, "destroy"]);
});