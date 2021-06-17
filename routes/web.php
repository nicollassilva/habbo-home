<?php

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

Route::redirect("/", "/login");

Route::prefix("home/")
    ->name("home.")
    ->middleware("auth")
    ->group(function() {
        Route::get("/index", [App\Http\Controllers\Home\HomeController::class, "index"])->name("index");
    });

Auth::routes();
