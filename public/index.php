<?php

use MinasRouter\Router\Route;

    require "../vendor/autoload.php";

Route::start(getenv("SITE_URL") ?? "https://localhost");

Route::namespace("App\Controllers")
    ->name("site.")
    ->group(function() {
        Route::get("/", "SiteController@index")->name("index");
    });

Route::execute();