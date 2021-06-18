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

        Route::get("/category/{id}/subcategories", [App\Http\Controllers\Home\HomeController::class, "subcategories"])
            ->name("category.subcategories")
            ->whereNumber('id');

        Route::get("/subcategory/{id}/products", [App\Http\Controllers\Home\HomeController::class, "subcategoryProducts"])
            ->name("subcategory.products")
            ->whereNumber('id');
    });

Auth::routes();
