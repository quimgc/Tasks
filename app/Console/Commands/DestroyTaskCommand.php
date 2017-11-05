<?php

namespace App\Console\Commands;

use App\Task;
use Illuminate\Console\Command;

class DestroyTaskCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'task:destroy {id? : The Task id}';



    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command is used to delete a Task';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        try{

            Task::destroy([
                'id'=>$this->argument('id') ? $this->argument('id') : $this->ask('Event id?')
            ]);
        } catch ( Exception $e) {
            $this->error('error' . $e);
        }

        $this->info('Task has been deleted to database succesfully');
    }
}
