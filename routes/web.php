<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\userListController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::middleware(['auth'])->group(function () {
    Route::get('/users', [userListController::class, 'index'])->name('dashboard');
    Route::get('user/create', [userListController::class, 'create'])->name('register');
    Route::post('user/save', [userListController::class, 'store'])->name('usersave');
    Route::get('/users/edit/{id}', [userListController::class, 'edit'])->name('userEdit');
    Route::get('/users/delete/{id}', [userListController::class, 'destroy'])->name('userDelete');
    Route::get('/user/otp/verification', [userListController::class, 'OtpPage'])->name('otpVerificationPage');
    Route::post('/verification', [userListController::class, 'OtpVerification'])->name('otpverification');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});
Route::get('/login', [AuthController::class, 'Login'])->name('login');
Route::get('', [AuthController::class, 'Login'])->name('login');
Route::post('/login/save', [AuthController::class, 'LoginSave'])->name('loginsave');


Route::get('/getStates/{countryCode}', [CountryController::class, 'getStates']);
Route::get('/getCities/{countryCode}/{stateCode}', [CountryController::class, 'getCities']);
