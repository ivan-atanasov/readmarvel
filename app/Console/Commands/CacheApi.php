<?php

namespace App\Console\Commands;

use GuzzleHttp\Client;
use Illuminate\Console\Command;

class CacheApi extends Command
{
    /**
     * The name and signature of the console command.
     * @var string
     */
    protected $signature = 'cache:api';

    /**
     * The console command description.
     * @var string
     */
    protected $description = 'Saves data from marvel API into the cache';

    /**
     * Create a new command instance.
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     * @return mixed
     */
    public function handle()
    {
        $ts = time();
        $hash = md5($ts . config('marvel.private_key') . config('marvel.public_key'));

        $client = new Client([
            'base_uri' => config('marvel.base_uri'),
            'query'    => [
                'apikey' => config('marvel.public_key'),
                'ts'     => $ts,
                'hash'   => $hash,
            ],
        ]);

        $endpoints = [
            'characters',
            'comics',
        ];

        $results_per_page = 20;
        $total_page_count = 4;

        $minutes_to_cache = 1440; // 1 day

        foreach ($endpoints as $ep) {

            $data = [];

            for ($x = 0; $x <= $total_page_count; $x++) {

                $query = $client->getConfig('query');
                $query['offset'] = $results_per_page * $x;

                $response = $client->get(config('marvel.base_uri') . $ep, ['query' => $query]);
                $response = json_decode($response->getBody(), true);
                $current_data = $response['data']['results'];
                $data = array_merge($data, $current_data);
            }

            \Cache::put($ep, $data, $minutes_to_cache);

        }
    }
}
