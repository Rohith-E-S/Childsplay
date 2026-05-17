<?php
namespace App\Http\Controllers;
use App\Models\Story;
use App\Models\Category;

class HomeController extends Controller {
    public function index() {
        $trendingStories = Story::with('category')->where('is_published', true)->inRandomOrder()->limit(4)->get();
        $categories = Category::all();
        return view('welcome', compact('trendingStories', 'categories'));
    }
}