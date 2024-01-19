<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TechnologyController;

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
    Route::get('/map-report', 'ReportController@mapReport')->name('map');
    // crud operation 
    Route::get('technologies', [TechnologyController::class, 'index'])->name('technologies.index');
    Route::get('technologies/create', [TechnologyController::class, 'create'])->name('technologies.create');
    Route::post('technologies', [TechnologyController::class, 'store'])->name('technologies.store');
    Route::get('technologies/{technology}', [TechnologyController::class, 'show'])->name('technologies.show');
    Route::get('technologies/{technology}/edit', [TechnologyController::class, 'edit'])->name('technologies.edit');
    Route::put('technologies/{technology}', [TechnologyController::class, 'update'])->name('technologies.update');
    Route::delete('technologies/{technology}', [TechnologyController::class, 'destroy'])->name('technologies.destroy');
});

Route::get('user/create', [UserController::class, 'create'])->name('register');
Route::post('user/save', [UserController::class, 'store'])->name('usersave');
Route::match(['get'], '/{login?}', [AuthController::class, 'Login'])->name('login');
Route::post('/login/save', [AuthController::class, 'LoginSave'])->name('loginsave');
