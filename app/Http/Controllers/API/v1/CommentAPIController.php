<?php

namespace App\Http\Controllers\API\v1;

use App\Models\Comment;

use Illuminate\Http\JsonResponse;

use App\Http\Controllers\Controller;

use App\Http\Resources\API\v1\UserResource;
use App\Http\Resources\API\v1\PostResource;
use App\Http\Resources\API\v1\CommentResource;

class CommentAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $comments = Comment::orderBy('id')->get();

        return response()->json([
            'status' => 'success',
            'data' => CommentResource::collection($comments),
        ], 200);
    }

    /**
     * Display the specified resource.
     * @param string $id
     * @return JsonResponse
     */
    public function show(string $id): JsonResponse
    {
        $comment = Comment::find($id);

        if (!$comment) {
            return response()->json([
                'status' => 'error',
                'message' => 'Comment not found',
            ], 404);

        }

        return response()->json([
            'status' => 'success',
            'data' => new CommentResource($comment),
        ], 200);
    }

    /**
     * Display the owner of the specified resource.
     * @param string $id
     * @return JsonResponse
     */
    public function user(string $id): JsonResponse
    {
        $comment = Comment::with('user')->find($id);

        if (!$comment) {
            return response()->json([
                'status' => 'error',
                'message' => 'Comment not found',
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => new UserResource($comment->user),
        ], 200);
    }

    /**
     * Display the post of the specified resource.
     * @param string $id
     * @return JsonResponse
     */
    public function post(string $id): JsonResponse
    {
        $comment = Comment::with('post')->find($id);

        if (!$comment) {
            return response()->json([
                'status' => 'error',
                'message' => 'Comment not found',
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => new PostResource($comment->post),
        ], 200);
    }
}
