<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\SearchPostRequest;
/* use Illuminate\Support\Facades\DB; */

use App\Http\Requests\Post\UpdatePostRequest;
use App\Models\Post;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

use App\Models\FollowUser;

class PostController extends Controller
{
   use AuthorizesRequests;

   public function index()
   {

    $userId = auth()->id();

    $posts = Post::with([
            'user:id,name',
            'images:id,post_id,image_url',
            'videos:id,post_id,video_url',
        ])
        ->select('id', 'title', 'content', 'user_id',)
        ->withCount('likes');


    if ($userId) {
        $posts = $posts->addSelect([
            'my_like_id' => \App\Models\Like::select('id')
                ->whereColumn('post_id', 'posts.id')
                ->where('user_id', $userId)
                ->limit(1),

            'my_bookmark_id' => \App\Models\Bookmark::select('id')
                ->whereColumn('post_id', 'posts.id')
                ->where('user_id', $userId)
                ->limit(1),
            'my_following_id' => FollowUser::select('id')
                ->whereColumn('following_id', 'posts.user_id')
                ->where('follower_id', $userId)
                ->limit(1),
        ])->get();
    }

    return response()->json(['data' => $posts]);

    }



    public function store(Request $request)
    {
        $this->authorize('store', Post::class);

        $post =  Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => auth()->id(),
            'topic_id' => $request->topic_id,
        ]);

        return response()->json(['message' => 'تم انشاء المنشور بنجاح', 'data' => $post]);
    }

    public function show(string $id)
    {
        $post = Post::with(['user:id,name', 'images:id,post_id,image_url', 'videos:id,post_id,video_url'])->withCount('likes')->findOrFail($id);

        return response()->json(['data' => $post]);
    }

    public function update(UpdatePostRequest $request, Post $post)
    {
        $this->authorize('update', $post);
        $post->update($request->validated());

        return response()->json(['message' => 'تم تحديث المنشور', 'data' => $post]);
    }

    public function destroy(Post $post)
    {
        $this->authorize('forceDelete', $post);
        $post->forceDelete();
        //! media files should be deleted

        return response()->json(['message' => 'تم حذف المنشور']);

    }

    public function withtrashed()
    {
        $posts = Post::withTrashed()->get();

        return response()->json(['data' => $posts]);
    }

    public function onlytrashed()
    {
        $posts = Post::onlyTrashed()->get();

        return response()->json(['data' => $posts]);
    }


    public function restore(string $id)
    {
        $post = Post::onlyTrashed()->findOrFail($id);
        $this->authorize('restore', $post);

        $post->restore();

        return response()->json(['message' => 'تم استعادة المنشور']);
    }

    // need to fix
    public function search(SearchPostRequest $request)
{
    $query = $request->validated()['query'];

    $posts = Post::where(function ($q) use ($query) {
        $q->where('title', 'LIKE', "%{$query}%")
          ->orWhere('content', 'LIKE', "%{$query}%");
    })->get();

    return response()->json(['data' => $posts]);
}

    public function getFollowingPosts()
    {
        $posts = Post::whereIn('user_id', function ($query) {
            $query->select('following_id')
                ->from('follow_users')
                ->where('follower_id', auth()->id());
        });

        $posts = $posts->with([
            'user:id,name',
            'images:id,post_id,image_url',
            'videos:id,post_id,video_url',
        ])
        ->select('id', 'title', 'content', 'user_id')->get();

        return response()->json(['data' => $posts]);

    }


    public function countPosts()
    {
        $count = Post::count();

        return response()->json(['count' => $count]);
    }
}

