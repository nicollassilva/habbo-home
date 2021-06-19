<?php

namespace App\Models\Home;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Item extends Model
{
    use HasFactory;
    
    protected $table = "users_home_items";

    protected $fillable = [
        'user_id', 'item_id', 'background', 'widget', 'theme'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, "item_id");
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function createFromAjax(Product $product)
    {
        $user = auth()->user();

        $user->items()->create([
            'item_id' => $product->id,
            'background' => $product->category_id === 1 ? 1 : 0,
            'widget' => $product->category_id === 4 ? 1 : 0,
            'theme' => $product->category_id === 4 ? 'default_skin' : null
        ]);
    }
}
