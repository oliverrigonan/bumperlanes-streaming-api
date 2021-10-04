<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserRightController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;

use App\Http\Controllers\FacilityController;
use App\Http\Controllers\ProviderAffiliationController;
use App\Http\Controllers\ProviderOfficeController;
use App\Http\Controllers\ProviderLogController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\SelectionCodeController;

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

    // Users
    Route::post('logout', LogoutController::class);
    Route::get('auth', [AuthController::class, 'index']);
    Route::post('auth', [AuthController::class, 'update']);

    Route::apiResource('users', UserController::class);

    Route::post('change-password', ChangePasswordController::class);

    Route::apiResource('facilities', FacilityController::class);
    Route::apiResource('providers', ProviderController::class);
    Route::apiResource('provider-affiliations', ProviderAffiliationController::class);
    Route::apiResource('provider-offices', ProviderOfficeController::class);
    Route::apiResource('provider-logs', ProviderLogController::class);
    Route::apiResource('selection-codes', SelectionCodeController::class);

    Route::get('selection-codes/category/{category}', [SelectionCodeController::class, 'index_by_category']);
    Route::get('provider-offices/provider/{provider_id}', [ProviderOfficeController::class, 'index_by_provider_id']);
    Route::get('provider-affiliations/provider/{provider_id}', [ProviderAffiliationController::class, 'index_by_provider_id']);
    Route::get('provider-logs/provider/{provider_id}', [ProviderLogController::class, 'index_by_provider_id']);

    Route::post('providers/image/upload', [ProviderController::class, 'upload_image']);

});