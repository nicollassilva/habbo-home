<?php

namespace App\Http\Controllers\Home;

use App\Models\User;
use App\Models\Home\Category;
use App\Models\Home\SubCategory;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        return view("home.index", [
            'background' => $user->activeBackground(),
            'items' => $user->placedItems(),
            'homeEditable' => true
        ]);
    }

    public function show($username)
    {
        if(!$user = User::whereUsername($username)->first()) {
            return redirect()->back();
        }

        return view("home.index", [
            'background' => $user->activeBackground(),
            'items' => $user->placedItems(),
            'user' => $user,
            'homeEditable' => false
        ]);
    }

    public function subcategories($id)
    {
        if(!$category = Category::with('subcategories')->find($id)) {
            return response()->json([
                "success" => false,
                "message" => "Categoria não encontrada."
            ], 204);
        }

        $subcategories = $category->subcategories->toArray();

        return response()->json([
            "success" => true,
            "data" => $subcategories
        ]);
    }

    public function subcategoryProducts($id)
    {
        if(!$subcategory = SubCategory::with('products.category')->find($id)) {
            return response()->json([
                "success" => false,
                "message" => "Subcategoria não encontrada."
            ], 204);
        }

        $products = $subcategory->products->toArray();

        return response()->json([
            "success" => true,
            "data" => $products
        ]);
    }
}
