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

    /** @var bool */
    protected $editable = false;

    public function make(Item $item, Bool $homeEditable)
    {
        if(!array_key_exists($item->product->id, $this->widgetMethods)) return;

        $this->item = $item;
        $this->editable = $homeEditable;

        $method = $this->widgetMethods[$item->product->id];

        return $this->{$method}();
    }

    protected function guestbook()
    {
        return view("home.widgets.widget-{$this->id()}", [
            'messages' => $this->user()->messages,
            'item' => $this->item,
            'isEditable' => $this->editAvailable()
        ])->render();
    }

    protected function profile()
    {
        return view("home.widgets.widget-{$this->id()}", [
            "item" => $this->item,
            'isEditable' => $this->editAvailable()
        ]);
    }

    protected function badges()
    {
        // $badges = app(HabboService::class)->make(
        //     $this->user()
        // )->badges();

        $badges = [];

        return view("home.widgets.widget-{$this->id()}", [
            "badges" => $badges,
            "item" => $this->item,
            'isEditable' => $this->editAvailable()
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

    protected function editAvailable()
    {
        if(!\Auth::check()) {
            return false;
        }

        return (auth()->id() === $this->user()->id) && $this->editable;
    }
}