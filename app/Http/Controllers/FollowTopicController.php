<?php

namespace App\Http\Controllers;

use App\Http\Requests\FollowTopic\FollowTopicRequest;
use App\Models\FollowTopic;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class FollowTopicController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FollowTopicRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();
        FollowTopic::create($data);

        return response()->json(['message' => 'تمت المتابعة']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FollowTopic $followTopic)
    {
        $this->authorize('delete', $followTopic);

        $followTopic->delete();
        return response()->json(['message' => 'تم الغاء المتابعة']);

    }
}
