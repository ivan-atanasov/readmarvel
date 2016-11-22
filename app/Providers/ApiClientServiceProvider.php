<?php

namespace App\Providers;

use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;

class ApiClientServiceProvider extends ServiceProvider
{
    protected $defer = true;

    /**
     * Bootstrap the application services.
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     * @return void
     */
    public function register()
    {
        $this->app->bind('GuzzleHttp\Client', function ($app) {
            $config = $app['config'];

            $timeStamp = time();
            $hash = md5($timeStamp . $config['marvel.private_key'] . $config['marvel.public_key']);

            return new Client([
                'base_uri' => $config['marvel.base_uri'],
                'query'    => [
                    'apikey' => $config['marvel.public_key'],
                    'ts'     => $timeStamp,
                    'hash'   => $hash,
                ],
            ]);
        });
    }

    /**
     * @return array
     */
    public function provides()
    {
        return ['GuzzleHttp\Client'];
    }
}
