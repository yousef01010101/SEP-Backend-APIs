<?php

namespace App\Http\Controllers;

use App\Http\Requests\Bookmark\BookmarkRequest;
use App\Models\Bookmark;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class BookmarkController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $bookmarks = Bookmark::with(['post:id,content,title','user:id,name'])
            ->select('id', 'post_id', 'user_id')
            ->where('user_id', auth()->id())
            ->get();

        return response()->json(['data' => $bookmarks]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BookmarkRequest $request)
    {

        $bookmark = Bookmark::where('user_id', auth()->id())->where('post_id', $request->post_id)->first();

        if ($bookmark) {
            return response()->json(['message' => 'لقد حفظ المستخدم المنشور بالفعل']);
        }

        Bookmark::create([
            'user_id' => auth()->id(),
            'post_id' => $request->post_id,
        ]);

        return response()->json(['message' => 'تم اضافة المنشور للمحفوظات']);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {}

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
    public function destroy(Bookmark $bookmark)
    {
        //?
        
        $this->authorize('delete', $bookmark);
        $bookmark->delete();

        return response()->json(['message' => 'تم ازالة المنشور من المحفوظات']);

    }
}
