<?php

namespace App\Http\Controllers;

use App\Http\Requests\Reply\ReplyRequest;
use App\Models\Reply;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
class ReplyController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index(string $id)
    {

        $replies = Reply::with('user:name,id')
            ->select('id','user_id', 'content', 'created_at')
            ->where('comment_id', $id)
            ->get();

        return response()->json(['data' => $replies]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ReplyRequest $request)
    {
        $this->authorize('create', Reply::class);
        $reply = Reply::create([
            'user_id' => auth()->id(),
            'comment_id' => $request->comment_id,
            'content' => $request->content,
        ]);

        return response()->json(['message' => 'تم اضافة التعليق بنجاح', 'data' => $reply]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $reply = Reply::with('user:name,id')
            ->findOrFail($id);

        return response()->json(['data' => $reply]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ReplyRequest $request, Reply $reply)
    {
        $this->authorize('update', $reply);
        $reply->update($request->validated());

        return response()->json(['message' => 'تم تحديث التعليق', 'data' => $reply]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reply $reply)
    {
        $this->authorize('delete', $reply);
        $reply->delete();

        return response()->json(['message' => 'تم حذف التعليق']);

    }
}
