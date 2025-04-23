<?php

namespace App\Http\Controllers\API\v1;

use App\Models\Category;

use Illuminate\Http\JsonResponse;

use App\Http\Controllers\Controller;

use App\Http\Resources\API\v1\PostResource;
use App\Http\Resources\API\v1\CategoryResource;

class CategoryAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $categories = Category::orderBy('id')->get();

        return response()->json([
            'success' => true,
            'data' => CategoryResource::collection($categories)
        ], 200);
    }

    /**
     * Display the specified resource.
     * @param string $id
     * @return JsonResponse
     */
    public function show(string $id): JsonResponse
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json([
                'success' => false,
                'message' => 'Category not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => new CategoryResource($category)
        ], 200);
    }

    /**
     * Display the posts of the specified category.
     * @param string $id
     * @return JsonResponse
     */
    public function posts(string $id): JsonResponse
    {
        $category = Category::with('posts')->find($id);

        if (!$category) {
            return response()->json([
                'success' => false,
                'message' => 'Category not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => PostResource::collection($category->posts)
        ], 200);
    }
}
