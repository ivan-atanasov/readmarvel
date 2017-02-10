<?php

namespace App\Listeners;

use App\Events\UserHasRegistered;
use Mail;
use Artisan;

class UserHasRegisteredListener
{
    /**
     * Handle the event.
     *
     * @param  UserHasRegistered $event
     *
     * @return void
     */
    public function handle(UserHasRegistered $event)
    {
        // @TODO 1. Send welcome e-mail
        $data = [
            'nickname' => 'Captain America',
            'subject'  => 'Thanks for registering',
            'email'    => $event->user->email,
        ];

        Mail::send('emails.welcome', $data, function ($m) use ($data) {
            $m->from('readmarvel@readmarvel.com', 'Read Marvel.com');
            $m->to($data['email'], $data['nickname'])->subject($data['subject']);
        });

        // 2. Add default lists for the current user
        Artisan::call('lists:generate', ['user_id' => $event->user->id]);
    }
}
