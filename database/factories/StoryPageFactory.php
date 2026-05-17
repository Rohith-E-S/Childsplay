<?php
namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;

class StoryPageFactory extends Factory {
    public function definition(): array {
        return [
            'story_id' => \App\Models\Story::factory(),
            'page_number' => fake()->numberBetween(1, 10),
            'image_url' => 'https://picsum.photos/seed/'.fake()->word().'/800/400',
            'content' => fake()->paragraphs(2, true),
        ];
    }
}