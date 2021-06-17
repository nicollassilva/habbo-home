<?php

namespace App\Models\Home;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Item extends Model
{
    use HasFactory;
    
    protected $table = "users_home_items";

    public function product()
    {
        return $this->belongsTo(Product::class, "item_id");
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
