<?php

namespace App\Listeners;

use App\Events\UserHasRegistered;
use App\Repositories\UserProfileRepository;
use Carbon\Carbon;
use Mail;
use Artisan;
use Lang;

class UserHasRegisteredListener
{
    /** @var UserProfileRepository */
    private $userProfileRepository;

    public function __construct(UserProfileRepository $userProfileRepository)
    {
        $this->userProfileRepository = $userProfileRepository;
    }

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
        $this->scheduleFollowupEmail($event);
        $this->createProfileEntry($event);
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
    private function scheduleFollowupEmail(UserHasRegistered $event)
    {
        $data = [
            'nickname' => $event->user->nickname,
            'subject'  => Lang::get('frontend/email.subject_followup'),
            'email'    => $event->user->email,
        ];

        Mail::send('emails.welcome_followup', $data, function ($message) use ($data) {
            $message->from('readmarvel@readmarvel.com', 'ReadMarvel.com');
            $message->to($data['email'], $data['nickname'])->subject($data['subject']);

            // Mailgun schedule date format and timezone
            $scheduleDate = Carbon::now()->setTimezone('UTC')->addDays(2)->toRfc822String();

            $headers = $message->getHeaders();
            $headers->addTextHeader('X-Mailgun-Deliver-By', $scheduleDate);
        });
    }

    /**
     * @param UserHasRegistered $event
     */
    private function createDefaultLists(UserHasRegistered $event)
    {
        Artisan::call('lists:generate', ['user_id' => $event->user->id]);
    }

    private function createProfileEntry(UserHasRegistered $event)
    {
        $data = [
            'user_id'   => $event->user->id,
            'real_name' => $event->user->name,
            'about_me'  => '',
        ];

        $this->userProfileRepository->updateOrCreate($event->user->id, $data);
    }
}
