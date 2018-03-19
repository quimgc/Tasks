<?php

namespace App\Console;

use App\Mail\HelloUser;
use App\Mail\ScheduledMail;
use App\User;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Mail;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     *
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {

        $now = Carbon::now()->toDateTimeString();
        $dateSendEmail = Carbon::create(2018, 03, 19)->toDateTimeString();

        if($now === $dateSendEmail){

            $schedule->call(function () {
                Mail::to('sergiturbadenas@gmail.com')->send(new ScheduledMail());
                Mail::to('quimgonzalez@iesebre.com')->send(new ScheduledMail());

            })->at('23:52');
        }
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
