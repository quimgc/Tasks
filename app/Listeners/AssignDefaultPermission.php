<?php

namespace App\Listeners;

use App\Events\LogedUser;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class AssignDefaultPermission implements ShouldQueue
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
        $event->user->assignRole('task-manager');

//        sleep(20);
        Log::info('Todo AssignDefaultPermission');
    }
}
