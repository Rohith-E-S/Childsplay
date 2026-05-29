<?php
namespace App\Http\Controllers;
use App\Models\Story;
use App\Models\Category;
use App\Models\ReadingHistory;
use Illuminate\Http\Request;

class StoryController extends Controller {
    public function index(Request $request) {
        $query = Story::with('category')->where('is_published', true);
        
        if ($request->has('category')) {
            $query->whereHas('category', function($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }
        
        if ($request->has('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $stories = $query->paginate(12);
        $categories = Category::all();
        return view('stories.index', compact('stories', 'categories'));
    }

    public function show(Story $story) {
        $story->load('category', 'reviews.user');
        return view('stories.show', compact('story'));
    }

    public function read(Story $story) {
        $story->load('pages');
        return view('stories.read', compact('story'));
    }

    public function saveProgress(Request $request, Story $story) {
        $childId = session('active_child_id');
        
        if (!$childId) {
            return response()->json(['error' => 'No active child profile selected'], 400);
        }

        ReadingHistory::create([
            'child_profile_id' => $childId,
            'story_id' => $story->id,
            'completed' => true,
        ]);

        return response()->json(['success' => true]);
    }
}