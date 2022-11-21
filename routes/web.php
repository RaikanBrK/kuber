<?php

use Illuminate\Http\Request;
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

Route::middleware(['counterViewerUser'])->group(function () {
    Route::get('/', function (Request $request) {
        return view('welcome', [
            "settings" => $request->settings
        ]);
    })->name('home');
});

require __DIR__.'/kuber/auth.php';