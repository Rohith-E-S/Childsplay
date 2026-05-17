<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\ChildProfile;
use App\Models\Category;
use App\Models\Story;
use App\Models\StoryPage;
use App\Models\Achievement;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin user
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@storynest.com',
            'role' => 'admin',
        ]);

        // Parent user with child profile
        $parent = User::factory()->create([
            'name' => 'John Parent',
            'email' => 'parent@storynest.com',
            'role' => 'parent',
        ]);

        $child = ChildProfile::factory()->create([
            'user_id' => $parent->id,
            'name' => 'Timmy',
            'age' => 7,
        ]);

        // Create Categories
        $categories = Category::factory()->count(6)->create();

        // Create Stories with Pages
        foreach ($categories as $category) {
            Story::factory()->count(3)->create([
                'category_id' => $category->id,
            ])->each(function ($story) {
                for ($i = 1; $i <= 5; $i++) {
                    StoryPage::factory()->create([
                        'story_id' => $story->id,
                        'page_number' => $i,
                    ]);
                }
            });
        }

        // Achievements
        Achievement::factory()->count(5)->create();
    }
}
