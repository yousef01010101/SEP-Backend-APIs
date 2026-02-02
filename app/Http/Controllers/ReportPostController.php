<?php

namespace App\Http\Controllers;

use App\Http\Requests\Report\StoreReportRequest;

use App\Models\ReportPost;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;

class ReportPostController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', ReportPost::class);

        $reports = ReportPost::with(['post:id,title,content', 'user:id,name'])
            ->select('id', 'user_id', 'post_id', 'status', 'type')->get();

        return response()->json(['data' => $reports]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReportRequest $request)
    {
        $this->authorize('create', ReportPost::class);

        ReportPost::create(array_merge(
            $request->validated(),
            ['user_id' => auth()->id()]
        ));

        return response()->json(['message' => 'تم الابلاغ عن المنشور بنجاح']);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $report = ReportPost::with('post:id,title,content')
            ->where('id', $id)
            ->firstOrFail();

        $this->authorize('view', $report);

        // ! if  the post is deleted we will see null
        return response()->json(['data' => $report]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update() {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) {}

   public function approve(ReportPost $reportPost)
   {


      $this->authorize('approve', $reportPost);
      if ($reportPost->post->trashed()) {

        dd($reportPost->post->trashed());
        return response()->json([
            'message' => 'المنشور تم حذفه مسبقاً'
        ], 409);
        }

      DB::transaction(function () use ($reportPost) {
        $reportPost->update([
            'status' => 'approved',
        ]);

        $reportPost->post->delete();
    });

    return response()->json([
        'status' => 'approved'
    ]);
   }


    public function reject(ReportPost $reportPost)
    {
        $this->authorize('update', $reportPost);

        $reportPost->update(['status' => 'rejected']);
        return response()->json(['status' => 'rejected']);
    }


    public function countReports()
    {
        $count = ReportPost::where('status', 'pending')->count();

        return response()->json(['count' => $count]);
    }
}
