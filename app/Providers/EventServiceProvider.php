<?php

namespace App\Providers;

use App\Events\LoginHistorial;
use App\Events\LoginHistorialEvent;
use App\Events\LogoutHistorialEvent;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Events\LogsEvent;
use App\Listeners\LogsListener;
use App\Events\TrazasEvent;
use App\Listeners\LoginHistorialListener;
use App\Listeners\LogoutHistorialListener;
use App\Listeners\TrazasListener;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        LoginHistorialEvent::class => [
            LoginHistorialListener::class
        ],
        LogoutHistorialEvent::class => [
            LogoutHistorialListener::class
        ],
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        LogsEvent::class => [
           LogsListener::class
        ],
        TrazasEvent::class => [
            TrazasListener::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
