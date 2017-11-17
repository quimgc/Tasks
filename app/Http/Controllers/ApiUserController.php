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
    
    
    public function show(User $user){
    
        return $user;
    }


    //La funció del request s'anomena injeccio de dependències.
    public function store(Request $request)
    {

       $request->validate([
            'name' => 'required'
        ]);

           $user =  User::create([
                'name' => $request->name
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
            'name' => 'required'
        ]);

        $user->name = $request->name;
        $user->save();

        return $user;

    }

}
