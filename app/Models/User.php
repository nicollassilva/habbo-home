<?php

namespace App\Models;

use App\Models\Home\Item;
use App\Models\Home\Message;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

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
        return $this->hasMany(Message::class);
    }

    public function getItems()
    {
        return $this->items()->with('product');
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
        return $this->getItems()
            ->whereIn('placed', [true, false])
            ->whereEditing(true)
            ->whereBackground(false)
            ->where("widget_id", "<>", null)
            ->get();
    }
}
