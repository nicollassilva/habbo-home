<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        return view("home.index", [
            'background' => $user->activeBackground(),
            'items' => $user->placedItems()
        ]);
    }
}
