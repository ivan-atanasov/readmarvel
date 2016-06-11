<?php


class SeriesRepositoryTest extends \Codeception\TestCase\Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    /**
     * @var \App\Repositories\SeriesRepository
     */
    protected $seriesRepository;

    /**
     * @var \GuzzleHttp\Client
     */
    protected $apiClient;

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

        $this->seriesRepository = new \App\Repositories\SeriesRepository($this->apiClient);
    }

    protected function _after()
    {
    }

    public function testRandomMethodReturnsRandomSeries()
    {
        $series = $this->seriesRepository->random(5);
        $this->assertEquals(5, count($series));

        $series = $this->seriesRepository->random(8);
        $this->assertEquals(8, count($series));

        $series = $this->seriesRepository->random(9);
        $this->assertNotEquals(8, count($series));
    }

    public function testFindMethodReturnsCorrectSeries()
    {
        $series = $this->seriesRepository->find(9996);
        $this->assertEquals(9996, $series['id']);
        $this->assertEquals('Acts of Vengeance (2011)', $series['title']);

        // test if the result is returned from the Cache
        $series = $this->seriesRepository->find(9996);
        $this->assertEquals(9996, $series['id']);
        $this->assertEquals('Acts of Vengeance (2011)', $series['title']);
    }
}