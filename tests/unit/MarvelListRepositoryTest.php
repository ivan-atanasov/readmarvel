<?php

use \App\Repositories\MarvelListRepository;

class MarvelListRepositoryTest extends \Codeception\TestCase\Test
{
    /** @var \UnitTester */
    protected $tester;

    /** @var MarvelListRepository */
    protected $marvelListRepository;

    /** @var \App\User */
    protected $user;

    protected function _before()
    {
        $this->marvelListRepository = new MarvelListRepository();

        $this->user = $this->tester->haveRecord('users', [
            'name'     => 'John Doe',
            'email'    => 'john.doe@test.dev',
            'password' => '123456',
        ]);

    }

    protected function _after()
    {
    }

    public function testDefaultListsReturnFourElements()
    {
        $lists = $this->marvelListRepository->defaultLists();
        $this->assertEquals(4, count($lists));
    }

    public function testAddMethodCreatesANewList()
    {
        $data = [
            'user_id' => $this->user,
            'title'   => 'A New List',
            'comment' => 'Just a cool comment',
        ];

        $this->marvelListRepository->add($data);
        $this->tester->seeRecord('marvel_lists', ['title' => 'A New List']);
    }

    public function testAllMethodReturnsAllListsForGivenUser()
    {
        $data = [
            'user_id' => $this->user,
            'title'   => 'A New List 1',
            'comment' => 'Just a cool comment 1',
        ];
        $this->marvelListRepository->add($data);

        $data = [
            'user_id' => $this->user,
            'title'   => 'A New List 2',
            'comment' => 'Just a cool comment 2',
        ];
        $this->marvelListRepository->add($data);

        $user = \App\User::find($this->user);
        $lists = $this->marvelListRepository->allForUser($user);

        $this->assertEquals(2, $lists->count());
    }
}
