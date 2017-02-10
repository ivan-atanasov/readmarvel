<?php

namespace App\Listeners;

use App\Events\UserHasRegistered;
use Mail;
use Artisan;
use Lang;

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
        $this->sendWelcomeEmail($event);
        $this->createDefaultLists($event);
    }

    /**
     * @param UserHasRegistered $event
     */
    private function sendWelcomeEmail(UserHasRegistered $event)
    {
        $data = [
            'nickname' => $event->user->nickname,
            'subject'  => Lang::get('frontend/email.subject_welcome'),
            'email'    => $event->user->email,
        ];

        Mail::send('emails.welcome', $data, function ($m) use ($data) {
            $m->from('readmarvel@readmarvel.com', 'Read Marvel.com');
            $m->to($data['email'], $data['nickname'])->subject($data['subject']);
        });
    }

    /**
     * @param UserHasRegistered $event
     */
    private function createDefaultLists(UserHasRegistered $event)
    {
        Artisan::call('lists:generate', ['user_id' => $event->user->id]);
    }
}
