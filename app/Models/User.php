<?php

namespace App\Models;

use App\Models\Home\Item;
use App\Models\Home\Message;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function items()
    {
        return $this->hasMany(Item::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class)->latest();
    }

    public function guestbookMessages()
    {
        return $this->messages()->limit(50)->get();
    }

    public function getItems()
    {
        return $this->items()->with('product');
    }

    public function getItemsByCategory($categoryId)
    {
        return $this->getItems()
                ->wherePlaced(false)
                ->whereEditing(false)
                ->whereHas('product', function($query) use ($categoryId) {
                    return $query->where('category_id', $categoryId);
                })
                ->get();
    }

    public function activeBackground()
    {
        return $this->getItems()
            ->whereBackground(true)
            ->wherePlaced(true)
            ->whereEditing(true)
            ->limit(1)
            ->first();
    }

    public function placedItems()
    {
        return $this->items()
            ->with('product.category')
            ->whereIn('placed', [true, false])
            ->whereEditing(true)
            ->whereBackground(false)
            ->where("widget_id", "<>", null)
            ->get();
    }
    
    public function hasSpecificWidget($product)
    {
        return $this->whereHas('items', function($query) use ($product) {
            return $query->where("item_id", $product);
        })->exists();
    }

    public function getSpecificItem($itemData)
    {
        return $this->items()->where(function($query) use ($itemData) {
            return $query->where("item_id", $itemData["item_id"])
                  ->where("widget_id", $itemData["widget_id"])
                  ->whereIn('placed', [true, false])
                  ->whereEditing(true);
        })->first();
    }

    public function discountCoins(Int $valueToDiscount)
    {
        if($this->coins < $valueToDiscount) {
            return false;
        }
        
        $this->coins -= $valueToDiscount;

        return $this->save();
    }
}
