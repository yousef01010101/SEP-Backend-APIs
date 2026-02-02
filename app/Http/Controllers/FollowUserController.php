<?php

namespace App\Http\Controllers;

use App\Http\Requests\FollowUser\FollowUserRequest;
use App\Models\FollowUser;
use Illuminate\Http\Request;
//use Laravel\Telescope\AuthorizesRequests;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class FollowUserController extends Controller
{

    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(FollowUserRequest $request)
    {


        $follow=FollowUser::where('follower_id',auth()->id())->where('following_id', $request->following_id)->first();


        if($follow){
            return response()->json(['message' => 'لقد تابعت هذا المستخدم بالفعل']);
        }

        FollowUser::create([
            'follower_id'=>auth()->id(),
            'following_id'=>$request->following_id,
        ]);

        return response()->json(['message' => 'تمت المتابعة']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FollowUser $followUser)
    {
        $this->authorize('delete', $followUser);

        $followUser->delete(); // ? add id to delete or no?
        return response()->json(['message' => 'تم الغاء المتابعة']);

    }
}
