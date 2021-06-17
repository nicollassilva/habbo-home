<?php

namespace App\Models\Home;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Messages extends Model
{
    use HasFactory;
    
    protected $table = "users_home_messages";

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
