<?php

namespace ReinVanOyen\CopiaSendcloud;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use ReinVanOyen\CopiaSendcloud\Events\ParcelChanged;
use ReinVanOyen\CopiaSendcloud\Listeners\UpdateOrder;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        ParcelChanged::class => [
            UpdateOrder::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }
}
