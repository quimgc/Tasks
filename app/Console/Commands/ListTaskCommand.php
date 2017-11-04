<?php

namespace App\Console\Commands;

use App\Task;
use Illuminate\Console\Command;

class ListTaskCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'task:list';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'List all tasks with a table format';

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

        //$headers = ['id','name','created_at','updated_at'];


        try{
            $tasks = Task::all()->toArray();
            $headers = array_keys($tasks[0]);

            $this->table($headers,$tasks);

        }catch (exception $e){
            $this->error('Error: ' . $e);
        }




    }
}
