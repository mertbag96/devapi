<?php

namespace Database\Seeders;

use App\Models\Tag;
use App\Models\Post;

use Illuminate\Database\Seeder;

class PostTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tagIds = Tag::pluck('id');

        Post::all()->each(function ($post) use ($tagIds) {
            $randomTags = $tagIds->random(rand(1, 5))->toArray();

            $post->tags()->syncWithoutDetaching($randomTags);
        });
    }
}
