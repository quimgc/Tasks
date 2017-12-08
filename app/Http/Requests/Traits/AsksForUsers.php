<?php

namespace App\Http\Requests\Traits;

use App\User;

/**
 * Trait ChecksPermissions.
 */
trait AsksForUsers
{
    /**
     * @param $user
     *
     * @return mixed
     */
    protected function askForUsers()
    {
        $users = User::all();

        //pluck és com si es fes un foreach buscant per nom i afegir-ho a un array.
        //el que fa es agafar el valor a partir d'una clau.
        // ho passem a array i ho mostrem.
        // + info README
        $user_names = $users->pluck('name')->toArray();
        $user_name = $this->choice('User id?', $user_names);

        return $users->where('name', $user_name)->first()->id;
    }
}
