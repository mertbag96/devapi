<?php

namespace App\Http\Controllers\API\v1;

use App\Models\Tag;

use Illuminate\Http\JsonResponse;

use App\Http\Controllers\Controller;

use App\Http\Resources\API\v1\TagResource;
use App\Http\Resources\API\v1\PostResource;

class TagAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $tags = Tag::orderBy('id')->get();

        return response()->json([
            'success' => true,
            'data' => TagResource::collection($tags),
        ], 200);
    }

    /**
     * Display the specified resource.
     * @param string $id
     * @return JsonResponse
     */
    public function show(string $id): JsonResponse
    {
        $tag = Tag::find($id);

        if (!$tag) {
            return response()->json([
                'success' => false,
                'message' => 'Tag not found',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => new TagResource($tag),
        ], 200);
    }

    /**
     * Display the posts of the specified resource.
     * @param string $id
     * @return JsonResponse
     */
    public function posts(string $id): JsonResponse
    {
        $tag = Tag::with('posts')->find($id);

        if (!$tag) {
            return response()->json([
                'success' => false,
                'message' => 'Tag not found',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => PostResource::collection($tag->posts),
        ], 200);
    }
}
