<?php

namespace App\Console\Commands;

use App\Task;
use Illuminate\Console\Command;
use Mockery\Exception;

class CreateTaskCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    //nom de la comanda quan s'executa.
    //També es definieix el format de la comanda, entre {} s'ha de posar els noms dels paràmetres
    protected $signature = "task:create {name? : The Task name}";

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
    //aqui s'ha de posar que ha de passar quan s'executa la comanda.
    public function handle()
    {
        //todo fer que aparegui l'error!



        try{

            Task::create([
                'name'=>$this->argument('name') ? $this->argument('name') : $this->ask('Event name?')
            ]);
        } catch ( Exception $e) {
            $this->error('error' . $e);
        }

        $this->info('Task has been added to database succesfully');
    }
}
