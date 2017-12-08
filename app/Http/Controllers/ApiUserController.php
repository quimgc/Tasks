<?php

namespace App\Http\Controllers;

use App\Http\Requests\DestroyUser;
use App\Http\Requests\ListUser;
use App\Http\Requests\ShowUser;
use App\Http\Requests\StoreUser;
use App\Http\Requests\UpdateUser;
use App\User;
use Illuminate\Http\Request;

class ApiUserController extends Controller
{
    public function index(ListUser $request)
    {
        return User::all();
    }

    public function show(ShowUser $user)
    {
        return $user;
    }

    //La funció del request s'anomena injeccio de dependències.
    public function store(StoreUser $request)
    {
        $request->validate([
           'name'     => 'required|max:255',
           'username' => 'sometimes|required|max:255|unique:users',
           'email'    => 'required|email|max:255|unique:users',
           'password' => 'required|min:6',
        ]);

        $user = User::create([
               'name'     => $request->name,
               'username' => $request->username,
               'email'    => $request->email,
               'password' => bcrypt($request->password),
            ]);

        return $user;
    }

    public function destroy(DestroyUser $user)
    {
        //el User $user és equivalent a $user = User::findOrFail($id)

        $user->delete();

        return $user;
    }

    public function update(UpdateUser $request, User $user)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $user->name = $request->name;
        $user->save();

        return $user;
    }
}
