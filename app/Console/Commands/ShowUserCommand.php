<?php

namespace App\Console\Commands;

use App\Http\Requests\Traits\AsksForUsers;
use App\User;
use Illuminate\Console\Command;

class ShowUserCommand extends Command
{
    use AsksForUsers;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:show {id? : The User id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Show a User by id.';

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
        $id = $this->argument('id') ? $this->argument('id') : $this->askForUsers();
        $user = User::findOrFail($id);

        try {
            $headers = ['Key', 'Value'];
            $info = [
                ['id', $user->id],
                ['Name', $user->name],
                ['email', $user->email],
            ];
            $this->table($headers, $info);
        } catch (Exception $e) {
            $this->error('error'.$e);
        }
    }
}
