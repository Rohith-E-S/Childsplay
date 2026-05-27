<?php
namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;

class ChildProfileFactory extends Factory {
    public function definition(): array {
        return [
            'user_id' => \App\Models\User::factory(),
            'name' => fake()->firstName(),
            'age' => fake()->numberBetween(4, 12),
            'reading_level' => fake()->randomElement(['Beginner', 'Intermediate', 'Advanced']),
            'interests' => fake()->randomElements(['Animals', 'Space', 'Magic', 'Science', 'Adventure'], 2),
            'avatar_url' => 'https://api.dicebear.com/7.x/fun-emoji/svg?seed=' . fake()->word(),
            'reading_streak' => fake()->numberBetween(0, 7),
        ];
    }
}