<?php

namespace App\Http\Controllers;

use App\Models\Home\Item;
use App\Models\Home\Product;
use Illuminate\Http\Request;
use App\Models\Home\Category;
use App\Http\Requests\StoreUpdateItem;

class UserController extends Controller
{
    public function productBuy($itemId, StoreUpdateItem $request)
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

    public function updateProfile(Request $request)
    {
        $items = json_decode($request->items, true);

        if(!is_array($items)) {
            return response()->json([
                "success" => true,
                "message" => "Sua página vazia foi salva!"
            ]);
        }

        $user = auth()->user();

        foreach($items as $itemData) {
            if($item = $user->getSpecificItem($itemData)) {
                $item->update($itemData);
            }
        }

        return response()->json([
            "success" => true,
            "message" => "Sua página ficou linda!",
            "redirect" => "/home/{$user->username}"
        ]);
    }

    public function showItemsByCategory($id)
    {
        return response()->json([
            "success" => true,
            "data" => auth()->user()->getItemsByCategory($id)
        ]);
    }
}
