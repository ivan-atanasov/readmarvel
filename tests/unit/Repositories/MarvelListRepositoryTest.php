<?php
namespace Tests\Unit\Repositories;

use \App\Repositories\MarvelListRepository;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use App\User;

/**
 * Class MarvelListRepositoryTest
 * @package Tests\Unit\Repositories
 */
class MarvelListRepositoryTest extends \Codeception\TestCase\Test
{
    /** @var \UnitTester */
    protected $tester;

    /** @var MarvelListRepository */
    protected $marvelListRepository;

    /** @var \App\User */
    protected $user;

    /** @var \App\User */
    protected $userWithList;

    /** @var \App\Entities\MarvelList */
    protected $list;

    protected function _before()
    {
        $this->marvelListRepository = new MarvelListRepository();

        $this->user = $this->tester->haveRecord('users', [
            'name'     => 'John Doe',
            'email'    => 'john.doe@test.dev',
            'password' => '123456',
        ]);

        $this->userWithList = $this->tester->haveRecord('users', [
            'name'     => 'Jahn Doe',
            'email'    => 'jane.doe@test.dev',
            'password' => '123456',
        ]);

        $this->list = $this->tester->haveRecord('marvel_lists', [
            'user_id' => $this->userWithList,
            'title'   => 'I will be reading',
            'comment' => 'Some nice comment',
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
        $file = 'tests/_data/image.png';
        $copied = 'tests/_data/image1.png';
        copy($file, $copied);

        $data = [
            'user_id' => $this->user,
            'title'   => 'A New List',
            'comment' => 'Just a cool comment',
            'avatar'  => new UploadedFile($copied, 'image.png', null, null, null, true),
        ];

        $this->marvelListRepository->add($data);
        $this->tester->seeRecord('marvel_lists', ['title' => 'A New List']);
    }

    public function testAllForUserMethodReturnsAllListsForGivenUser()
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

        $user = User::find($this->user);
        $lists = $this->marvelListRepository->allForUser($user);

        $this->assertEquals(2, $lists->count());
    }

    public function testAddToListActuallyAddsAndItemToAList()
    {
        $data = [
            'list_id'   => $this->list,
            'series_id' => 9996,
            'score'     => 3,
            'progress'  => 2,
        ];
        $this->marvelListRepository->addItemToList($data);

        $data = [
            'list_id'     => $this->list,
            'series_id'   => 9997,
            'score'       => 3,
            'progress'    => 2,
            'started_at'  => '2015/02',
            'finished_at' => '2015/03',
        ];
        $this->marvelListRepository->addItemToList($data);

        $listItems = $this->marvelListRepository->items($this->list);
        $this->assertEquals(2, $listItems->count());
    }

    public function testFindMethodReturnsCorrectList()
    {
        $firstList = $this->tester->haveRecord('marvel_lists', [
            'user_id' => $this->userWithList,
            'title'   => 'I will be reading',
            'comment' => 'Some nice comment',
        ]);

        $secondList = $this->tester->haveRecord('marvel_lists', [
            'user_id' => $this->userWithList,
            'title'   => 'I dropped',
            'comment' => 'Some nice comment',
        ]);

        $firstListResult = $this->marvelListRepository->find($firstList);
        $secondListResult = $this->marvelListRepository->find($secondList);

        $this->assertEquals('I will be reading', $firstListResult->title);
        $this->assertEquals('I dropped', $secondListResult->title);
    }

    public function testUpdateAvatar()
    {
        $file = 'tests/_data/image.png';
        $copied = 'tests/_data/image1.png';
        copy($file, $copied);

        $list = $this->marvelListRepository->updateAvatar(
            $this->list,
            new UploadedFile($copied, 'image.png', null, null, null, true)
        );

        $this->assertEquals('image.png', $list->avatar);
    }

    public function testListContainsItemsByUser()
    {
        $this->tester->haveRecord('marvel_lists', [
            'user_id' => $this->userWithList,
            'title'   => 'I will be reading',
            'comment' => 'Some nice comment',
        ]);

        $this->tester->haveRecord('marvel_lists', [
            'user_id' => $this->userWithList,
            'title'   => 'I dropped',
            'comment' => 'Some nice comment',
        ]);

        $data = [
            'list_id'     => $this->list,
            'series_id'   => 9997,
            'score'       => 3,
            'progress'    => 2,
            'started_at'  => '2015/02',
            'finished_at' => '2015/03',
        ];
        $item = $this->marvelListRepository->addItemToList($data);

        $lists = $this->marvelListRepository->listsContainingItemByUser(
            User::find($this->userWithList),
            $item->series_id
        );

        $this->assertEquals(1, count($lists));
    }

    public function testUpdateListItemInfo()
    {
        $this->tester->haveRecord('marvel_lists', [
            'user_id' => $this->userWithList,
            'title'   => 'I will be reading',
            'comment' => 'Some nice comment',
        ]);

        $this->tester->haveRecord('marvel_lists', [
            'user_id' => $this->userWithList,
            'title'   => 'I dropped',
            'comment' => 'Some nice comment',
        ]);

        $data = [
            'list_id'     => $this->list,
            'series_id'   => 9997,
            'score'       => 3,
            'progress'    => 2,
            'started_at'  => '2015/02',
            'finished_at' => '2015/03',
        ];
        $item = $this->marvelListRepository->addItemToList($data);

        $item = $this->marvelListRepository->item($item->id);
        $this->assertEquals($item->score, $data['score']);
        $this->assertEquals($item->progress, $data['progress']);

        $updateData = [
            'list_id'     => $this->list,
            'series_id'   => 9997,
            'score'       => 7,
            'progress'    => 16,
            'started_at'  => '2015/02',
            'finished_at' => '2015/03',
        ];
        $this->marvelListRepository->updateItemInList($item->id, $updateData);

        $item = $this->marvelListRepository->item($item->id);
        $this->assertEquals($item->score, $updateData['score']);
        $this->assertEquals($item->progress, $updateData['progress']);
    }

    public function testDeleteItemFromList()
    {
        $this->tester->haveRecord('marvel_lists', [
            'user_id' => $this->userWithList,
            'title'   => 'I will be reading',
            'comment' => 'Some nice comment',
        ]);

        $this->tester->haveRecord('marvel_lists', [
            'user_id' => $this->userWithList,
            'title'   => 'I dropped',
            'comment' => 'Some nice comment',
        ]);

        $data = [
            'list_id'     => $this->list,
            'series_id'   => 9997,
            'score'       => 3,
            'progress'    => 2,
            'started_at'  => '2015/02',
            'finished_at' => '2015/03',
        ];
        $item = $this->marvelListRepository->addItemToList($data);
        $this->assertNotEmpty($item);

        $this->marvelListRepository->deleteItemFromList($item->id);
        $item = $this->marvelListRepository->item($item->id);
        $this->assertNull($item);
    }
}
