<?php

namespace App\Http\Controllers;

use App\Http\Requests\Comment\CommentRequest;
use App\Models\Comment;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CommentController extends Controller
{
    use AuthorizesRequests;

    public function index(string $post_id)
    {

        $comments = Comment::with('user:id,name')
            ->select('id', 'content', 'created_at', 'user_id')
            ->where('post_id', $post_id)
            ->get();

        return response()->json(['data' => $comments]);

    }

    public function store(CommentRequest $request)
    {

        $comment = Comment::create([
            'user_id' => auth()->id(),
            'post_id' => $request->post_id,
            'content' => $request->content,
        ]);

        return response()->json(['message' => 'تم اضافة تعليقك بنجاح', 'data' => $comment]);
    }

    public function show(string $id)
    {

        $comment = Comment::with('user:id,name')
            ->select('id', 'content', 'created_at', 'user_id')
            ->where('id', $id)
            ->firstOrFail();

        return response()->json(['data' => $comment]);

    }

    public function update(CommentRequest $request, Comment $comment)
    {
        $this->authorize('update', $comment);

        $comment->update($request->validated());

        return response()->json(['message' => 'تم تحديث تعليقك بنجاح', 'data' => $comment]);

    }

    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);
        $comment->delete();

        return response()->json(['message' => 'تم حذف تعليقك بنجاح']);

    }
}
