<?php

use MinasRouter\Router\Route;

    require "../vendor/autoload.php";

Route::start(getenv("SITE_URL") ?? "https://localhost");

Route::namespace("App\Controllers")
    ->name("users.")
    ->group(function() {
        Route::get("/", "UserController@index")->name("index");
        Route::get("/users/create", "UserController@create")->name("create");
        Route::post("/users/store", "UserController@store")->name("store");
    });

Route::execute();