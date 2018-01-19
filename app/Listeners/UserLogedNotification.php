<?php

namespace App\Listeners;

use App\Events\LogedUser;
use Illuminate\Support\Facades\Log;

class UserLogedNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param object $event
     *
     * @return void
     */
    public function handle(LogedUser $event)
    {
        Log::info('Todo UserLoggedNotification');
    }
}
