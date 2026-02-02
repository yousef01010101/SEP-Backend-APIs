<?php

namespace App\Http\Controllers;

use App\Http\Requests\Video\VideoRequest;
use App\Models\Video;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(VideoRequest $request)
    {
        $validated = $request->validated();
        
        $post = \App\Models\Post::findOrFail($validated['post_id']);
        $this->authorize('update', $post);

        $real_video = $request->file('video');
        $path = $real_video->store('postvideo', 'public');
        $validated['video_url'] = Storage::url($path);

        $video = Video::create($validated);

        return response()->json(['message' => 'تم رفع الفيديو بنجاح', 'data' => $video]);
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
    public function update(VideoRequest $request, Video $video)
    {
        $this->authorize('update', $video);
        $validated = $request->validated();

        $old_url = $video->video_url;

        $real_video = $request->file('video');
        $path = $real_video->store('postvideo', 'public');
        $validated['video_url'] = Storage::url($path);

        $video->update($validated);

        // remove previous file from storage (public disk)
        $old_path = parse_url($old_url, PHP_URL_PATH);
        Storage::disk('public')->delete(preg_replace('#^/storage/#', '', $old_path));

        return response()->json(['message' => 'تم التحديث', 'data' => $video]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Video $video)
    {
        $this->authorize('delete', $video);

        // remove file from storage (public disk)
        $old_url = $video->video_url;
        $old_path = parse_url($old_url, PHP_URL_PATH);
        Storage::disk('public')->delete(preg_replace('#^/storage/#', '', $old_path));

        $video->delete();

        return response()->json(['message' => 'تم الحذف']);
    }
}
