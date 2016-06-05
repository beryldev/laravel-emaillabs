<?php

namespace Beryldev\EmailLabs;

use Log;
use Illuminate\Support\Arr;
use Illuminate\Support\ServiceProvider;
use GuzzleHttp\Client as HttpClient;
use Beryldev\EmailLabs\Transport\EmailLabsTransport;

class EmailLabsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/emaillabs.php' => config_path('emaillabs.php'),
            ], 'config');

        $transportManager = $this->app['swift.transport'];
        $this->registerEmailLabsTransport($transportManager);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Get to register our custom email driver
     *
     * @return void
     * @author Sebastian
     **/
    protected function registerEmailLabsTransport($manager)
    {
        $manager->extend('emaillabs', function(){
            $config = $this->app['config']->get('emaillabs', []);
            $client = $this->getHttpClient($config);

            return new EmailLabsTransport($client, $config);
        });
    }

    /**
     * Prepare configured http client
     *
     * @return GuzzleHttp\Client
     * @author Sebastian
     **/
    protected function getHttpClient($config)
    {
        $guzzleConfig = Arr::get($config, 'guzzle', []);
        return new HttpClient(Arr::add($guzzleConfig, 'connect_timeout', 60));
    }
}
