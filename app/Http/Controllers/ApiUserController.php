<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class ApiUserController extends Controller
{
    public function index()
    {
        return User::all();
    }

    public function show(User $user)
    {
        return $user;
    }

    //La funció del request s'anomena injeccio de dependències.
    public function store(Request $request)
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

    public function destroy(Request $request, User $user)
    {
        //el User $user és equivalent a $user = User::findOrFail($id)

        $user->delete();

        return $user;
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $user->name = $request->name;
        $user->save();

        return $user;
    }
}
