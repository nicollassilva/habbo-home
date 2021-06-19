<?php

namespace App\Http\Controllers\Home;

use App\Models\Home\Item;
use App\Models\Home\Product;
use App\Models\Home\Category;
use App\Models\Home\SubCategory;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateItem;

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

    public function buyItem($itemId, StoreUpdateItem $request)
    {
        if(!$product = Product::find($itemId)) {
            return response()->json([
                "success" => false,
                "message" => "Item não encontrado."
            ], 204);
        }

        $user = auth()->user();

        if($product->category_id === 4 && $user->hasSpecificWidget($product->id)) {
            return response()->json([
                "success" => false,
                "message" => "Você já possui esse widget."
            ]);
        }

        $itemValue = ceil($product->value * $request->quantity);

        if(!$product->availableForPurchase()) {
            return response()->json([
                "success" => false,
                "message" => "Quantidade de itens vendidos esgotado."
            ]);
        }

        if(!$user->discountCoins($itemValue)) {
            return response()->json([
                "success" => false,
                "message" => "Você não possui moeda suficiente."
            ]);
        }

        for($i = 1; $i <= $request->quantity; $i++) {
            Item::createFromAjax($product);
        }

        return response()->json([
            "success" => true,
            "message" => "Compra bem sucedida!"
        ]);
    }
}
