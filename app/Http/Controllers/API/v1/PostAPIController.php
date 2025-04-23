<?php

namespace App\Http\Controllers\API\v1;

use App\Models\Post;

use Illuminate\Http\JsonResponse;

use App\Http\Controllers\Controller;

use App\Http\Resources\API\v1\TagResource;
use App\Http\Resources\API\v1\UserResource;
use App\Http\Resources\API\v1\PostResource;
use App\Http\Resources\API\v1\CommentResource;
use App\Http\Resources\API\v1\CategoryResource;

class PostAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $posts = Post::orderBy('id')->get();

        return response()->json([
            'status' => 'success',
            'data' => PostResource::collection($posts),
        ], 200);
    }

    /**
     * Display the specified resource.
     * @param string $id
     * @return JsonResponse
     */
    public function show(string $id): JsonResponse
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json([
                'status' => 'error',
                'message' => 'Post not found',
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => new PostResource($post),
        ], 200);
    }

    /**
     * Display the owner of the specified resource.
     * @param string $id
     * @return JsonResponse
     */
    public function user(string $id): JsonResponse
    {
        $post = Post::with('user')->find($id);

        if (!$post) {
            return response()->json([
                'status' => 'error',
                'message' => 'Post not found',
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => new UserResource($post->user),
        ], 200);
    }

    /**
     * Display the category of the specified resource.
     * @param string $id
     * @return JsonResponse
     */
    public function category(string $id): JsonResponse
    {
        $post = Post::with('category')->find($id);

        if (!$post) {
            return response()->json([
                'status' => 'error',
                'message' => 'Post not found',
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => new CategoryResource($post->category),
        ], 200);
    }

    /**
     * Display the comments of the specified resource.
     * @param string $id
     * @return JsonResponse
     */
    public function comments(string $id): JsonResponse
    {
        $post = Post::with('comments')->find($id);

        if (!$post) {
            return response()->json([
                'status' => 'error',
                'message' => 'Post not found',
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => CommentResource::collection($post->comments),
        ], 200);
    }

    /**
     * Display the tags of the specified resource.
     * @param string $id
     * @return JsonResponse
     */
    public function tags(string $id): JsonResponse
    {
        $post = Post::with('tags')->find($id);

        if (!$post) {
            return response()->json([
                'status' => 'error',
                'message' => 'Post not found',
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => TagResource::collection($post->tags),
        ], 200);
    }
}
