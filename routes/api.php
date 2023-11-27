<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;

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

Route::middleware(['auth:sanctum','api'])
->group(function () {
    Route::prefix("auth")
        ->group(function () {
            Route::get('/me', [AuthController::class, "handleGetMe"]);
            Route::post('/change-password', [AuthController::class, "handleChangePassword"]);
    });
});

Route::prefix("auth")->group(function () {
    Route::post("login", [AuthController::class, "handleLogin"]);
    Route::post("register", [AuthController::class, "handleRegister"]);

});
