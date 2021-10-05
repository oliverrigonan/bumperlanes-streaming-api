<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;

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

// Public users
Route::post('login', LoginController::class);
Route::post('register', RegisterController::class);

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::post('logout', LogoutController::class);
    Route::get('auth', [AuthController::class, 'index']);
    Route::post('auth', [AuthController::class, 'update']);
    Route::apiResource('users', UserController::class);
    Route::post('change-password', ChangePasswordController::class);
});
