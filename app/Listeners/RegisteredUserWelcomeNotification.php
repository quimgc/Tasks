<?php

namespace App\Listeners;

use App\Events\RegisteredUser;
use App\Mail\HelloUser;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class RegisteredUserWelcomeNotification implements ShouldQueue
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
     * @param RegisteredUser $event
     */
    public function handle(RegisteredUser $event)
    {

        $hello = new HelloUser($event->user);
        Mail::to($event->user)->send($hello);

    }
}
