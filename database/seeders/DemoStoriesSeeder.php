<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Story;
use App\Models\StoryPage;
use App\Models\Category;

class DemoStoriesSeeder extends Seeder
{
    /**
     * Run the demo stories seeder.
     */
    public function run(): void
    {
        // Ensure categories exist and reuse them to avoid unique slug collisions
        $categories = Category::all();
        if ($categories->isEmpty()) {
            $categories = Category::factory()->count(6)->create();
        }

        // Create 20 demo stories, each with 4 pages, assigned to existing categories
        Story::factory()->count(20)->make()->each(function ($story) use ($categories) {
            $story->category_id = $categories->random()->id;
            $story->save();

            StoryPage::factory()->count(4)->create([
                'story_id' => $story->id,
            ]);
        });
    }
}
