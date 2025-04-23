<?php

namespace App\Http\Controllers\API\v1;

use App\Models\User;

use Illuminate\Http\JsonResponse;

use App\Http\Controllers\Controller;

use App\Http\Resources\API\v1\UserResource;
use App\Http\Resources\API\v1\PostResource;
use App\Http\Resources\API\v1\CommentResource;

class UserAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $users = User::orderBy('id')->get();

        return response()->json([
            'success' => true,
            'data' => UserResource::collection($users)
        ], 200);
    }

    /**
     * Display the specified resource.
     * @param string $id
     * @return JsonResponse
     */
    public function show(string $id): JsonResponse
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => new UserResource($user)
        ], 200);
    }

    /**
     * Display the posts of the specified resource.
     * @param string $id
     * @return JsonResponse
     */
    public function posts(string $id): JsonResponse
    {
        $user = User::with('posts')->find($id);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => PostResource::collection($user->posts)
        ], 200);
    }

    /**
     * Display the comments of the specified resource.
     * @param string $id
     * @return JsonResponse
     */
    public function comments(string $id): JsonResponse
    {
        $user = User::with('comments')->find($id);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => CommentResource::collection($user->comments)
        ], 200);
    }
}
