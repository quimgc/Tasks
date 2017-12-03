<?php

namespace App\Console\Commands;

use App\Http\Requests\Traits\AsksForTasks;
use App\Task;
use Illuminate\Console\Command;
use Mockery\Exception;

class EditTaskCommand extends Command
{
    use AsksForTasks;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'task:edit {id? : The Task id} {name? : The Task name} {user_id? : The user id} {description? : The Task description}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Edit an existing task.';

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
        //si ens passen l'id, l'agafem, però sino mostrem tots els id amb l'ajuda del Trait.
        $id = $this->argument('id') ? $this->argument('id') : $this->askForTasks();

        $task = Task::findOrFail($id);

        try{
            $task->update([
                'name'        => $this->argument('name') ? $this->argument('name') : $this->ask('Task name?'),
                'user_id'     => $this->argument('user_id') ? $this->argument('user_id') : $this->ask('User id?'),
                'description' => $this->argument('description') ? $this->argument('description') : $this->ask('Task description?'),
            ]);

        }catch(Exception $e){
            $this->error('error' . $e);
        }
        $this->info('Task has been edited succesfully');
    }
}
