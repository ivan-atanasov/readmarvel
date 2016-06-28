<?php
namespace Tests\Unit\Console\Commands;


use App\Console\Commands\GenerateDefaultLists;
use App\Repositories\MarvelListRepository;
use App\User;
use Faker\Factory;
use Artisan;

class GenerateDefaultListsTest extends \Codeception\TestCase\Test
{
    /** @var \UnitTester */
    protected $tester;

    /** @var \Faker\Factory */
    private $faker;

    /** @var  GenerateDefaultLists */
    protected $generateDefaultListsCommand;

    /** @var MarvelListRepository */
    protected $marvelListRepository;

    /** @var User */
    protected $user;

    protected function _before()
    {
        $this->faker = Factory::create();

        $this->marvelListRepository = new MarvelListRepository();
        $this->generateDefaultListsCommand = new GenerateDefaultLists($this->marvelListRepository);

        $this->user = \App\User::create([
            'name'     => $this->faker->name,
            'email'    => $this->faker->safeEmail,
            'password' => 'qwe123',
        ]);
    }

    protected function _after()
    {
    }

    public function testDefaultListsAreGenerated()
    {
        Artisan::call('lists:generate', ['user_id' => $this->user->id]);

        $resultAsText = Artisan::output();
        $this->assertEquals($resultAsText, "Lists for user {$this->user->id} have been successfully generated\n");

        foreach ($this->marvelListRepository->defaultLists() as $list) {
            $this->tester->seeRecord('marvel_lists', ['user_id' => $this->user->id, 'title' => $list['title']]);
        }
    }
}