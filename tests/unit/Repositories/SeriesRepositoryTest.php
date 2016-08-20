<?php
namespace Tests\Unit\Repositories;

use Config;
use GuzzleHttp\Client;
use App\Repositories\SeriesRepository;

/**
 * Class SeriesRepositoryTest
 * @package Tests\Unit\Repositories
 */
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

        $this->apiClient = new Client([
            'base_uri' => 'http://gateway.marvel.com/v1/public/',
            'query'    => [
                'apikey' => Config::get('marvel.public_key'),
                'ts'     => $ts,
                'hash'   => $hash,
            ],
        ]);

        $this->seriesRepository = new SeriesRepository($this->apiClient);
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

    /**
     * @skip
     */
    public function testSearchMethod()
    {
        $query = 'Spider-Man';
        $results = $this->seriesRepository->search($query, 20, 0);

        $this->assertTrue(isset($results[0]));
        $this->assertNotEmpty($results[0]);

        $query = 'Spider-Man';
        $results = $this->seriesRepository->search($query, 20, 0);

        $this->assertTrue(isset($results[0]));
        $this->assertNotEmpty($results[0]);

        $query = 'Some jibberish string';
        $results = $this->seriesRepository->search($query, 20, 0);
        $this->assertTrue(isset($results[0]));
        $this->assertEmpty($results[0]);
    }
}