<?php

use App\Http\Controllers\administrators\AdministratorController;
use App\Http\Controllers\Auth\AdminLoginController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::prefix('admin')->name('admin.')->group(function () {
    // Login Controller
    Route::controller(AdminLoginController::class)->group(function() {
        Route::get('login', 'showLoginForm')->name('login');
        Route::post('login', 'login'); 
        Route::post('logout', 'logout')->name('logout');
    });

    // Administrador controller
    Route::middleware('auth')->group(function() {
        Route::resource('administrators', AdministratorController::class);
        Route::controller(AdministratorController::class)->middleware('admin.master')->name('administrators.')->group(function () {
            Route::get('transferir-super-admin', 'transferMaster')->name('transferMaster.index');
            Route::post('transferir-super-admin', 'transferMasterStore')->name('transferMaster.store');
        });
        Route::controller(AdministratorController::class)->group(function() {
            Route::get('profile', 'profile')->name('profile');
        });
    });

    Route::get('dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});
