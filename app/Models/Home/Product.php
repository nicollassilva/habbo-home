<?php

namespace App\Models\Home;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    
    protected $table = "home_items";

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function availableForPurchase()
    {
        if(!$this->purchase_limit) {
            return true;
        }

        if(Item::where('item_id', $this->id)->count() < $this->purchase_limit) {
            return true;
        }

        return false;
    }
}
