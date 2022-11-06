<?php

use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\SettingsUserController;
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

    Route::middleware(['auth', 'admin.master'])->group(function() {
        // Administrador controller
        Route::resource('administrators', AdministratorController::class)->except('show');
        Route::controller(AdministratorController::class)->name('administrators.')->group(function () {
            Route::get('transferir-super-admin', 'transferMaster')->name('transferMaster.index');
            Route::post('transferir-super-admin', 'transferMasterStore')->name('transferMaster.store');
        });

        // ProfileController
        Route::controller(ProfileController::class)->group(function() {
            Route::get('profile', 'index')->name('profile');
            Route::put('profile/{id}', 'update')->name('profile.update');
        });

        // SettingsUser Controller
        Route::controller(SettingsUserController::class)->prefix('profile')->name('profile.')->group(function() {
            Route::get('settings', 'index')->name('settings');
            Route::post('settings', 'store')->name('settings.store');
        });

        // Settings Controller
        Route::controller(SettingsController::class)->prefix('settings')->name('settings.')->group(function() {
            Route::get('tags', 'tags')->name('tags');
        });
    });

    Route::get('dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});
