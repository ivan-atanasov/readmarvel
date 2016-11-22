<?php

namespace Tests\Unit\Listeners;


use App\Events\UserHasRegistered;
use App\Listeners\UserHasRegisteredListener;
use App\Repositories\MarvelListRepository;
use App\User;

class UserHasRegisteredListenerTest extends \Codeception\TestCase\Test
{
    /** @var \UnitTester */
    protected $tester;

    /** @var \App\User */
    protected $user;

    /** @var MarvelListRepository */
    protected $marvelListRepository;

    protected function _before()
    {
        $this->user = $this->tester->haveRecord('users', [
            'name'     => 'Jahn Doe',
            'email'    => 'jane.doe@test.dev',
            'password' => '123456',
        ]);

        $this->marvelListRepository = new MarvelListRepository();
    }

    public function testHandleMethod()
    {
        $user = User::find($this->user);
        $event = new UserHasRegistered($user);
        $listener = new UserHasRegisteredListener();
        $listener->handle($event);

        foreach ($this->marvelListRepository->defaultLists() as $list) {
            $this->tester->seeRecord('marvel_lists', ['user_id' => $user->id, 'title' => $list['title']]);
        }
    }
}
