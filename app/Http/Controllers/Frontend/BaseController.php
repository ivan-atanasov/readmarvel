<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Config;

/**
 * Class BaseController
 * @package App\Http\Controllers\Frontend
 */
class BaseController extends Controller
{
    /** @var Client */
    protected $client;

    /**
     * BaseController constructor.
     */
    public function __construct()
    {
        $this->client = $this->initializeApiClient();
    }

    /**
     * Connects to the Marvel API
     * @return Client
     */
    protected function initializeApiClient()
    {
        $timeStamp = time();
        $hash = md5($timeStamp . Config::get('marvel.private_key') . Config::get('marvel.public_key'));

        return new Client([
            'base_uri' => Config::get('marvel.base_uri'),
            'query'    => [
                'apikey' => Config::get('marvel.public_key'),
                'ts'     => $timeStamp,
                'hash'   => $hash,
            ],
        ]);
    }
}
