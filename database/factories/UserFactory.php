<?php

namespace Database\Factories;

use Illuminate\Support\Str;

use Illuminate\Support\Facades\Hash;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $firstName = $this->faker->unique()->firstName;
        $lastName = $this->faker->unique()->lastName;
        $fullName = Str::title($firstName) . ' ' . Str::title($lastName);

        $email = Str::lower($firstName) . '.' . Str::lower($lastName) . '@example.com';
        return [
            'name' => $fullName,
            'email' => $email,
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
