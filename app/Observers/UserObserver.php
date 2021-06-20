<?php

namespace App\Observers;

use App\Models\User;

class UserObserver
{
    /**
     * Handle the User "created" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function created(User $user)
    {
        $item = $user->items()->create([
            "item_id" => 898,
            "x" => 480,
            "y" => 70,
            "z" => 0,
            "widget" => 1,
            "theme" => "default_skin",
            "placed" => 1,
            "editing" => 1
        ]);

        $item->widget_id = random_int(0, 100000);
        $item->save();
    }

    /**
     * Handle the User "updating" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function updating(User $user)
    {
        //
    }
}
