<?php

namespace App\Models\Home;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Widget extends Model
{
    use HasFactory;

    protected $themes = [
        "golden_skin",
        "default_skin",
        "bubble_skin",
        "metal_skin",
        "notepad_skin",
        "note_skin",
        "hcm_skin",
        "hcgirl_skin"
    ];

    protected $table = "users_home_widgets";

    public function themes()
    {
        return collect($this->themes);
    }
}
