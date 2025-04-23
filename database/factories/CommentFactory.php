<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Post;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'post_id' => Post::factory(),
            'comment' => $this->faker->sentences(rand(1, 5), true),
            'rating' => $this->faker->numberBetween(1, 5),
            'created_at' => now(),
        ];
    }
}
