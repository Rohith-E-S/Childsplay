<?php
namespace App\Http\Controllers;
use App\Models\Story;
use App\Models\User;
use App\Models\Category;

class AdminController extends Controller {
    public function index() {
        $stats = [
            'users' => User::count(),
            'stories' => Story::count(),
            'categories' => Category::count(),
        ];
        $recentStories = Story::latest()->limit(5)->get();
        return view('admin.dashboard', compact('stats', 'recentStories'));
    }

    public function create() {
        $categories = Category::all();
        return view('admin.stories.create', compact('categories'));
    }

    public function store(\Illuminate\Http\Request $request) {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|unique:stories',
            'description' => 'nullable|string',
            'cover_image' => 'nullable|url',
            'author' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'age_group' => 'nullable|string',
            'reading_level' => 'nullable|string',
            'duration_minutes' => 'nullable|integer',
            'is_published' => 'boolean'
        ]);

        Story::create($validated);
        return redirect()->route('admin.dashboard')->with('success', 'Story created successfully.');
    }

    public function edit(Story $story) {
        $categories = Category::all();
        return view('admin.stories.edit', compact('story', 'categories'));
    }

    public function update(\Illuminate\Http\Request $request, Story $story) {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|unique:stories,slug,' . $story->id,
            'description' => 'nullable|string',
            'cover_image' => 'nullable|url',
            'author' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'age_group' => 'nullable|string',
            'reading_level' => 'nullable|string',
            'duration_minutes' => 'nullable|integer',
            'is_published' => 'boolean'
        ]);

        $validated['is_published'] = $request->has('is_published');
        
        $story->update($validated);
        return redirect()->route('admin.dashboard')->with('success', 'Story updated successfully.');
    }

    public function destroy(Story $story) {
        $story->delete();
        return redirect()->route('admin.dashboard')->with('success', 'Story deleted successfully.');
    }
}