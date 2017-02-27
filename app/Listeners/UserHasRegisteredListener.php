<?php

namespace App\Listeners;

use App\Events\UserHasRegistered;
use Carbon\Carbon;
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

        Mail::send('emails.welcome', $data, function ($message) use ($data) {
            $message->from(\Config::get('mail.contact_form_to_email'), 'ReadMarvel.com');
            $message->to($data['email'], $data['nickname'])->subject($data['subject']);
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
