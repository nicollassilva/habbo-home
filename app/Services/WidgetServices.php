<?php

namespace App\Services;

use App\Models\Home\Item;

class WidgetServices
{
    /** @var array */
    protected $widgetMethods = [
        898 => "userProfile",
        899 => "guestbook"
    ];

    /** @var object */
    protected $item;

    public function make(Item $item)
    {
        if(!array_key_exists($item->product->id, $this->widgetMethods)) return;

        $this->item = $item;

        $method = $this->widgetMethods[$item->product->id];

        return $this->{$method}();
    }

    protected function guestbook()
    {
        $userMessages = $this->item->user->messages;

        return view("home.widgets.widget-{$this->item->product->id}", [
            'messages' => $userMessages,
            'item' => $this->item
        ])->render();
    }

    protected function userProfile()
    {
        return view("home.widgets.widget-{$this->item->product->id}", [
            "item" => $this->item,
            "user" => $this->item->user
        ]);
    }
}