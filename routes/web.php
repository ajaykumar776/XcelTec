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
    Route::post('user/save', [userListController::class, 'store'])->name('saveUser');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});
Route::get('/login', [AuthController::class, 'Login'])->name('login');
Route::post('/login/save', [AuthController::class, 'LoginSave'])->name('loginsave');
