<?php

namespace ReinVanOyen\CopiaSendcloud;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use Illuminate\Support\ServiceProvider;
use ReinVanOyen\CopiaSendcloud\Client\Api;
use ReinVanOyen\CopiaSendcloud\Client\SendcloudClient;

class CopiaSendcloudServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(EventServiceProvider::class);

        $this->app->bind('sendcloud.httpClient', function ($app) {
            return new Client([
                'base_uri' => config('copia-sendcloud.sendcloud_base_url'),
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ],
                'auth' => [config('copia-sendcloud.sendcloud_public_key'), config('copia-sendcloud.sendcloud_secret_key'),],
            ]);
        });

        $this->app->singleton(SendcloudClient::class, SendcloudClient::class);
        $this->app->when(SendcloudClient::class)
            ->needs(ClientInterface::class)
            ->give('sendcloud.httpClient');

        $this->app->singleton(Api::class, Api::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/copia-sendcloud.php', 'copia-sendcloud');
        $this->loadRoutesFrom(__DIR__.'/../routes/webhooks.php');

        if ($this->app->runningInConsole()) {
            $this->registerPublishes();
        }
    }

    /**
     * @return void
     */
    private function registerPublishes()
    {
        $this->publishes([
            __DIR__.'/../config/copia-sendcloud.php' => config_path('copia-sendcloud.php'),
        ], 'copia-sendcloud-config');
    }
}
