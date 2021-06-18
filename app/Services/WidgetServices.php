<?php

namespace App\Services;

use App\Models\Home\Item;

class WidgetServices
{
    /** @var array */
    protected $widgetMethods = [
        898 => "profile",
        899 => "guestbook",
        900 => "badges"
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
        return view("home.widgets.widget-{$this->id()}", [
            'messages' => $this->user()->messages,
            'item' => $this->item
        ])->render();
    }

    protected function profile()
    {
        return view("home.widgets.widget-{$this->id()}", [
            "item" => $this->item
        ]);
    }

    protected function badges()
    {
        // $badges = app(HabboService::class)->make(
        //     $this->user()
        // )->badges();

        return view("home.widgets.widget-{$this->id()}", [
            "badges" => [],
            "item" => $this->item
        ]);
    }

    protected function id()
    {
        return $this->item->product->id;
    }
    
    protected function user()
    {
        return $this->item->user;
    }
}