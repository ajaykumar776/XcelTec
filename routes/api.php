<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\userListController;

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


// Protected route - requires authentication
Route::middleware('auth:api')->group(function () {
    Route::post('user/save/', [userListController::class, 'StoreSave']);
    Route::post('otp/verification', [userListController::class, 'OtpverificationByApi']);
});
Route::post('/login', [AuthController::class, 'APILogin'])->name('api.login');
Route::get('/getCities/{stateId}', [userListController::class, 'getAllCities']);
Route::get('/getStates/{country_id}', [userListController::class, 'getAllStates']);
