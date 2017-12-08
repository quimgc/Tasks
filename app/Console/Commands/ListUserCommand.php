<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;

class ListUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:list';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'List all users with a table format.';

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
            $tasks = User::all()->toArray();
            $headers = array_keys($tasks[0]);

            $this->table($headers, $tasks);
        } catch (exception $e) {
            $this->error('Error: '.$e);
        }
    }
}
