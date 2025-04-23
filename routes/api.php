<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\v1\TagAPIController;
use App\Http\Controllers\API\v1\UserAPIController;
use App\Http\Controllers\API\v1\PostAPIController;
use App\Http\Controllers\API\v1\CommentAPIController;
use App\Http\Controllers\API\v1\CategoryAPIController;

// Version 1
Route::prefix('v1')->group(function () {
    // Users
    Route::prefix('users')->group(function () {
        // All users
        Route::get('/', [UserAPIController::class, 'index']);

        // User's details
        Route::get('/{id}', [UserAPIController::class, 'show']);

        // User's posts
        Route::get('/{id}/posts', [UserAPIController::class, 'posts']);

        // User's comments
        Route::get('/{id}/comments', [UserAPIController::class, 'comments']);
    });

    // Categories
    Route::prefix('categories')->group(function () {
        // All categories
        Route::get('/', [CategoryAPIController::class, 'index']);

        // Category's details
        Route::get('/{id}', [CategoryAPIController::class, 'show']);

        // Category's posts
        Route::get('/{id}/posts', [CategoryAPIController::class, 'posts']);
    });

    // Posts
    Route::prefix('posts')->group(function () {
        // All posts
        Route::get('/', [PostAPIController::class, 'index']);

        // Post's details
        Route::get('/{id}', [PostAPIController::class, 'show']);

        // Post's owner
        Route::get('/{id}/user', [PostAPIController::class, 'user']);

        // Post's category
        Route::get('/{id}/category', [PostAPIController::class, 'category']);

        // Post's comments
        Route::get('/{id}/comments', [PostAPIController::class, 'comments']);

        // Post's tags
        Route::get('/{id}/tags', [PostAPIController::class, 'tags']);
    });

    // Comments
    Route::prefix('comments')->group(function () {
        // All comments
        Route::get('/', [CommentAPIController::class, 'index']);

        // Comment's details
        Route::get('/{id}', [CommentAPIController::class, 'show']);

        // Comment's owner
        Route::get('/{id}/user', [CommentAPIController::class, 'user']);

        // Comment's post
        Route::get('/{id}/post', [CommentAPIController::class, 'post']);
    });

    // Tags
    Route::prefix('tags')->group(function () {
        // All tags
        Route::get('/', [TagAPIController::class, 'index']);

        // Tag's details
        Route::get('/{id}', [TagAPIController::class, 'show']);

        // Tag's posts
        Route::get('/{id}/posts', [TagAPIController::class, 'posts']);
    });
});
