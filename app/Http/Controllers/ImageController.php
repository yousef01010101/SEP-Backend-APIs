<?php

namespace App\Http\Controllers;

use App\Http\Requests\Image\ImageRequest;
use App\Models\Image;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(ImageRequest $request)
    {
        $validated = $request->validated();
        $post = \App\Models\Post::findOrFail($validated['post_id']);
        $this->authorize('update', $post);

        $real_image = $request->file('image');
        $path = $real_image->store('postimage', 'public');
        $validated['image_url'] = Storage::url($path);

        $image = Image::create($validated);

        return response()->json(['message' => 'تم رفع الصورة بنجاح', 'data' => $image]);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {}

    /**
     * Update the specified resource in storage.
     */
    public function update(ImageRequest $request, Image $image)
    {
        $this->authorize('update', $image);
        $validated = $request->validated();

        $old_url = $image->image_url;

        $real_image = $request->file('image');
        $path = $real_image->store('postimage', 'public');
        $validated['image_url'] = Storage::url($path);

        $image->update($validated);


        $old_path = parse_url($old_url, PHP_URL_PATH);
        Storage::disk('public')->delete(preg_replace('#^/storage/#', '', $old_path));

        return response()->json(['message' => 'تم التحديث', 'data' => $image]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Image $image)
    {
        $this->authorize('delete', $image);

        // remove file from storage (public disk)
        $old_url = $image->image_url;
        // remove file from storage (public disk)
        $old_path = parse_url($old_url, PHP_URL_PATH);
        Storage::disk('public')->delete(preg_replace('#^/storage/#', '', $old_path));

        $image->delete();

        return response()->json(['message' => 'تم حذف الصورة']);

    }
}
