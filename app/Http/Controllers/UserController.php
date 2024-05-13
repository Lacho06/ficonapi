<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return response()->json($users, 200);
    }

    public function login(Request $request){
        $user = User::where('email', $request->email)->first();

        if(Hash::check($request->password, $user->password)){
            return response()->json(['user' => $user, 'jwt' => bcrypt($user->id.$user->password)], 200);
        }

        return response()->json(['user' => null, 'jwt' => ''], 200);

    }
}
