<?php

namespace App\Models\Home;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubCategory extends Model
{
    use HasFactory;

    protected $table = "home_subcategories";

    public function category()
    {
        return $this->hasOne(Category::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class, "subcategory_id");
    }
}
