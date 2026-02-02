<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use \App\Models\User;

class UserController extends Controller
{


    public function index(){}




    public function update(Request $request, User $user)
    {
        $user = auth()->user();
        $request->validate([
            'name' => 'string|max:255',
            'email' => 'email|unique:users,email,' . $user->id,
        ]);

        $user->update($request->only('name', 'email'));

        return response()->json([
            'message' => 'تم تحديث البيانات بنجاح',
            'user' => $user
        ]);

    }


    public function countUsers()
    {
        $count = User::count();
        return response()->json(['count' => $count]);
    }


}
