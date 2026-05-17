<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Story;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $stats = [
            'users' => User::count(),
            'stories' => Story::count(),
            'categories' => Category::count(),
        ];
        $stories = Story::with('category')->latest()->get();

        return view('admin.dashboard', compact('stats', 'stories'));
    }

    public function create()
    {
        $categories = Category::all();

        return view('admin.stories.create', compact('categories'));
    }

    public function store(Request $request)
    {
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
            'is_published' => 'boolean',
        ]);

        $story = Story::create($validated);

        return redirect()->route('admin.stories.pages.manage', $story)->with('success', 'Story created! Now add the story pages.');
    }

    public function edit(Story $story)
    {
        $categories = Category::all();

        return view('admin.stories.edit', compact('story', 'categories'));
    }

    public function update(Request $request, Story $story)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|unique:stories,slug,'.$story->id,
            'description' => 'nullable|string',
            'cover_image' => 'nullable|url',
            'author' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'age_group' => 'nullable|string',
            'reading_level' => 'nullable|string',
            'duration_minutes' => 'nullable|integer',
            'is_published' => 'boolean',
        ]);

        $validated['is_published'] = $request->has('is_published');

        $story->update($validated);

        if ($request->has('redirect_to_pages')) {
            return redirect()->route('admin.stories.pages.manage', $story)->with('success', 'Story updated! Now manage pages.');
        }

        return redirect()->route('admin.dashboard')->with('success', 'Story updated successfully.');
    }

    public function destroy(Story $story)
    {
        $story->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Story deleted successfully.');
    }
}
