<?php

use App\Models\User;
use App\Services\HabboService;
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
        Route::get("/index", "Home\HomeController@index")->name("index");
        Route::get("/{username}", "Home\HomeController@show")->name("show");

        Route::get("/category/{id}/subcategories", "Home\HomeController@subcategories")
            ->name("category.subcategories")
            ->whereNumber('id');

        Route::get("/subcategory/{id}/products", "Home\HomeController@subcategoryProducts")
            ->name("subcategory.products")
            ->whereNumber('id');

        Route::post("/item/{id}/store", "Home\HomeController@buyItem")
            ->name("items.store")
            ->whereNumber("id");

        Route::put("/items/update", "Home\HomeController@updateProfile")
            ->name("items.update");
    });

Auth::routes();
