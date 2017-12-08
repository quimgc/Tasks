<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;

class CreateUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:create {name? : The User name} {email? : The user email } {password? : The user password }';

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
    public function handle()
    {
        try {
            User::create([
                'name'     => $this->argument('name') ? $this->argument('name') : $this->ask('User name?'),
                'email'    => $this->argument('email') ? $this->argument('email') : $this->ask('User email?'),
                'password' => $this->argument('password') ? $this->argument('password') : $this->ask('User password?'),
            ]);
        } catch (Exception $e) {
            $this->error('error'.$e);
        }

        $this->info('User has been added to database succesfully');
    }
}
