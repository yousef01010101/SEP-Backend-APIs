<?php

namespace App\Http\Controllers;

use App\Http\Requests\Topic\SaveTopicRequest;
use App\Http\Requests\Topic\UpdateTopicRequest;
use App\Models\Topic;

class TopicController extends Controller
{
    use \Illuminate\Foundation\Auth\Access\AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $topics = Topic::all();

        return response()->json(['data' => $topics]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SaveTopicRequest $request)
    {
        $this->authorize('create', Topic::class);
        Topic::create($request->validated());

        return response()->json(['message' => 'تم الانشاء']);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $topic = Topic::with('posts')->findOrFail($id);

        return response()->json(['data' => $topic]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTopicRequest $request, Topic $topic)
    {
        $this->authorize('update', $topic);
        $topic->update($request->validated());

        return response()->json(['message' => 'تم التحديث', 'data' => $topic]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Topic $topic)
    {
        $this->authorize('delete', $topic);
        $topic->delete();

        return response()->json(['message' => 'تم الحذف بنجاح']);
    }

    public function topTopics()
    {
        $topics = Topic::withCount('posts')->orderByDesc('posts_count')->limit(5)->get();

        return response()->json(['data' => $topics]);
    }
}
