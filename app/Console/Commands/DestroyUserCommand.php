<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;

class DestroyUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:destroy {id? : The user id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command destroy an existing user by id';

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
        try {
            $id = $this->argument('id') ? $this->argument('id') : $this->ask('User id?');
            $count = User::destroy($id);
        } catch (Exception $e) {
            $this->error('error'.$e);
        }
        if ($count == 0) {
            $this->alert('User does not exist');
        } else {
            $this->info('User has been deleted to database succesfully');
        }
    }
}
