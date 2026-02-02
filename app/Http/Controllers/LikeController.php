<?php

namespace App\Http\Controllers;

use App\Http\Requests\Like\StoreLikeRequest;
use App\Models\Like;
use Illuminate\Http\Request;

class LikeController extends Controller
{

    use \Illuminate\Foundation\Auth\Access\AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLikeRequest $request)
    {
        $like = Like::where('user_id', auth()->id())->where('post_id', $request->post_id)->first();

        if ($like) {
            return response()->json(['message' => 'لقد سجل المستخدم اعجاب بالفعل']);
        }

        $like = Like::create([
            'user_id' => auth()->id(),
            'post_id' => $request->post_id,

        ]);

        $count = Like::where('post_id', $request->post_id)->count(); //!

        return response()->json(['message' => 'تم الاعجاب', 'count' => $count, 'id'=>$like->id]);
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
    public function destroy(Like $like)
    {

            $this->authorize('delete', $like);

            $like->delete();

            $count = Like::where('post_id', $like->post_id)->count(); //!

            return response()->json(['message' => 'تم الحذف', 'count' => $count]);


    }
}
