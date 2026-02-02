<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FollowTopicController;
use App\Http\Controllers\FollowUserController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\ReportPostController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;




Route::middleware('throttle:uploads')
    ->group(function () {

        Route::post('register', [AuthController::class, 'register']);
        Route::post('login', [AuthController::class, 'login']);
        Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:api'); // ?delete or post
        Route::get('me', [AuthController::class, 'me'])->middleware('auth:api');

        Route::get('post', [PostController::class, 'index']);
        Route::get('users/count', [UserController::class, 'countUsers']);
        Route::get('posts/count', [PostController::class, 'countPosts']);
        Route::get('reports/count', [ReportPostController::class, 'countReports']);

        Route::middleware('auth:api')
            ->group(function () {


                Route::put('user/update', [UserController::class, 'update']);
                Route::get('post/{id}', [PostController::class, 'show']);
                Route::post('post/', [PostController::class, 'store']);

                Route::get('search/', [PostController::class, 'search']); // !need to test
                Route::get('withtrashed', [PostController::class, 'withtrashed']); // note: dont use uri:post/
                Route::get('onlytrashed', [PostController::class, 'onlytrashed']);
                Route::get('followingPosts', [PostController::class, 'getFollowingPosts']);
                Route::delete('forcedelete/{id}', [PostController::class, 'forceDelete']);
                Route::post('restore/{id}', [PostController::class, 'restore']); // ?post or put

                Route::apiResource('post', PostController::class)->except(['index', 'show', 'store']);

                Route::get('comments/{post_id}', [CommentController::class, 'index']);
                Route::get('comment/{id}', [CommentController::class, 'show']);

                Route::post('comment/', [CommentController::class, 'store']);

                Route::apiResource('comment', CommentController::class)->except(['index', 'show', 'store']);

                Route::post('like', [LikeController::class, 'store']);

                Route::delete('like/{like}', [LikeController::class, 'destroy']);

                Route::get('replies/{comment_id}', [ReplyController::class, 'index']);
                Route::get('reply/{id}', [ReplyController::class, 'show']);
                Route::post('reply', [ReplyController::class, 'store']);

                Route::apiResource('reply', ReplyController::class)->except(['index', 'show', 'store']);

                Route::get('bookmarks', [BookmarkController::class, 'index']);
                Route::post('bookmark', [BookmarkController::class, 'store']);
                Route::delete('bookmark/{bookmark}', [BookmarkController::class, 'destroy']);

                Route::get('topTopics', [TopicController::class, 'topTopics']);
                Route::get('topic/{id}', [TopicController::class, 'show']);
                Route::apiResource('topic', TopicController::class)->except(['show']);

                Route::apiResource('followTopic', FollowTopicController::class)->only(['store', 'destroy']);

                Route::apiResource('followUser', FollowUserController::class)->only(['store', 'destroy']);

                Route::apiResource('image', ImageController::class)->only(['store', 'update', 'destroy']);

                Route::apiResource('video', VideoController::class)->only(['store', 'update', 'destroy']);

                Route::get('reportPost/{id}', [ReportPostController::class, 'show']);

                Route::put('reportPostApprove/{reportPost}', [ReportPostController::class, 'approve']);

                Route::put('reportPost/{reportPost}', [ReportPostController::class, 'reject']);

                Route::apiResource('reportPost', ReportPostController::class)->only(['index', 'store']);

            }); // end of auth:api

    }); // end of throttle:uploads
