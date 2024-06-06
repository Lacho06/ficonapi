<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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

    public function store(Request $request){
        $url = null;
        if($request->image){
            $url = Storage::put('images', $request->image);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'image' => $url,
        ]);

        return response()->json($user, 201);
    }

    public function update(Request $request, User $user){
        if($request->image){
            if($user->image){
                Storage::delete($user->image);
            }
            $url = Storage::put('image', $request->image);

            $user->update([
                'image' => $url
            ]);
        }


        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return response()->json($user, 200);
    }

    public function destroy(User $user){
        if($user->image){
            Storage::delete($user->image);
        }

        $user->delete();

        return response()->json([
            'message' => 'Usuario eliminado correctamente'
        ], 200);
    }
}
