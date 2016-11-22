<?php

namespace App\Listeners;

use App\Events\UserHasRegistered;

class UserHasRegisteredListener
{
    /**
     * Handle the event.
     *
     * @param  UserHasRegistered  $event
     * @return void
     */
    public function handle(UserHasRegistered $event)
    {
        // @TODO 1. Send welcome e-mail

        // 2. Add default lists for the current user
        \Artisan::call('lists:generate', ['user_id' => $event->user->id]);
    }
}
