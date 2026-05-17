<?php
namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class StoryFactory extends Factory {
    public function definition(): array {
        $title = fake()->sentence(4);
        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'description' => fake()->paragraph(),
            'cover_image' => 'https://picsum.photos/seed/'.fake()->word().'/800/600',
            'author' => fake()->name(),
            'category_id' => \App\Models\Category::factory(),
            'age_group' => fake()->randomElement(['3-5', '6-8', '9-12']),
            'reading_level' => fake()->randomElement(['Beginner', 'Intermediate', 'Advanced']),
            'duration_minutes' => fake()->numberBetween(3, 15),
            'is_published' => true,
        ];
    }
}