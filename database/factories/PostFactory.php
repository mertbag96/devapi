<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Category;

use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->unique()->sentence;

        return [
            'user_id' => User::factory(),
            'category_id' => Category::factory(),
            'slug' => Str::slug($title),
            'title' => Str::title($title),
            'image' => 'https://picsum.photos/seed/' . $this->faker->uuid . '/640/480',
            'summary' => $this->faker->paragraph,
            'content' => $this->faker->paragraphs(rand(3, 7), true),
        ];
    }
}
