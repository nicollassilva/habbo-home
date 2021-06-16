<?php

use App\Utils\View;

if(! function_exists('view')) {
    function view($name, $variables = []) {
        return View::render($name, $variables);
    }
}