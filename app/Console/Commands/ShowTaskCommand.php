<?php

namespace App\Console\Commands;

use App\Http\Requests\Traits\AsksForTasks;
use App\Task;
use Illuminate\Console\Command;
use Mockery\Exception;

class ShowTaskCommand extends Command
{
    use AsksForTasks;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'task:show {id? : The Task id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Show a Task by id.';

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
        //si no me passen id, el demano.
        $id = $this->argument('id') ? $this->argument('id') : $this->askForTasks();
        $task = Task::findOrFail($id);

        try{

            $headers = ['Key', 'Value'];
            $info = [
                ['id', $task->id],
                ['Name', $task->name],
                ['User_id', $task->user_id],
                ['Description', $task->description],



            ];
            $this->table($headers,$info);

        }catch(Exception $e){

            $this->error('error' . $e);
        }

    }
}
