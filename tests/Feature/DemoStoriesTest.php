<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Database\Seeders\DemoStoriesSeeder;
use App\Models\Story;

class DemoStoriesTest extends TestCase
{
    use RefreshDatabase;

    public function test_demo_stories_seeder_creates_stories(): void
    {
        $this->seed(DemoStoriesSeeder::class);

        $this->assertGreaterThanOrEqual(20, Story::count());
    }
}
