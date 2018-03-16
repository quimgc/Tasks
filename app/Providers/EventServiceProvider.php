<?php

namespace App\Providers;

use App\Events\LogedUser;
use App\Events\RegisteredUser;
use App\Listeners\AssignDefaultPermission;
use App\Listeners\RegisteredUserWelcomeNotification;
use App\Listeners\UserLogedNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        LogedUser::class => [
            UserLogedNotification::class,

        ],
        RegisteredUser::class => [
            AssignDefaultPermission::class,
            RegisteredUserWelcomeNotification::class,
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

        //
    }
}
