<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;

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


Route::middleware(['middleware' => 'session'])->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('dashboard')->middleware('user_type');
    Route::get('/user-dashboard', [UserController::class, 'UserDashboard'])->name('user_dashboard');
    Route::get('/users/edit/{id}', [UserController::class, 'edit'])->name('userEdit');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/registration-report', 'ReportController@registrationReport')->name('registration');
    Route::get('/technology-report', 'ReportController@technologyReport')->name('technology');
});
Route::get('user/create', [UserController::class, 'create'])->name('register');
Route::post('user/save', [UserController::class, 'store'])->name('usersave');
Route::match(['get'], '/{login?}', [AuthController::class, 'Login'])->name('login');
Route::post('/login/save', [AuthController::class, 'LoginSave'])->name('loginsave');
