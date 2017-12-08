<?php

namespace App\Console\Commands;

use App\Http\Requests\Traits\AsksForUsers;
use App\User;
use Illuminate\Console\Command;

class EditUserCommand extends Command
{
    use AsksForUsers;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:edit {id? : The User id} {name? : The User name} {email? : The user email}';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Edit an existing user.';

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
        $id = $this->argument('id') ? $this->argument('id') : $this->askForUsers();

        $user = User::findOrFail($id);

        try {
            $user->update([
                'name'        => $this->argument('name') ? $this->argument('name') : $this->ask('User name?'),
                'email'     => $this->argument('email') ? $this->argument('user_id') : $this->ask('User email?'),
            ]);
        } catch (Exception $e) {
            $this->error('error'.$e);
        }
        $this->info('User has been edited succesfully');

    }
}
