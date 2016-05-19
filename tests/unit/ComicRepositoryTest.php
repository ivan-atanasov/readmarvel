<?php

class ComicRepositoryTest extends \Codeception\TestCase\Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    /**
     * @var \GuzzleHttp\Client
     */
    protected $apiClient;

    /**
     * @var \App\Repositories\Contracts\ComicRepository
     */
    protected $comicRepository;


    protected function _before()
    {
        $ts = time();
        $hash = md5($ts . Config::get('marvel.private_key') . Config::get('marvel.public_key'));

        $this->apiClient = new GuzzleHttp\Client([
            'base_uri' => 'http://gateway.marvel.com/v1/public/',
            'query'    => [
                'apikey' => Config::get('marvel.public_key'),
                'ts'     => $ts,
                'hash'   => $hash,
            ],
        ]);

        $this->comicRepository = new \App\Repositories\ComicRepository($this->apiClient);
    }

    protected function _after()
    {
        Cache::forget('comics');
    }

    public function testRandomReturnsRandomNumberOfComicBooks()
    {
        $results = $this->comicRepository->random(); // default should return 10
        $this->assertEquals(count($results), 10);

        $results = $this->comicRepository->random(5);
        $this->assertEquals(count($results), 5);
    }

    public function testSearchMethodReturnsCorrectResults()
    {
        $results = $this->comicRepository->search('spider-man', 20, 0);
        $this->assertEquals(count($results[0]), 20);

        foreach ($results[0] as $comic) {
            $this->assertNotFalse(stristr($comic['title'], 'spider-man'));
        }
    }
}
