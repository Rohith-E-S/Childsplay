<?php
namespace App\Http\Controllers;
use App\Models\ChildProfile;
use Illuminate\Http\Request;

class ChildProfileController extends Controller {
    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer|min:2|max:15',
            'reading_level' => 'required|string',
        ]);
        $validated['avatar_url'] = 'https://api.dicebear.com/7.x/fun-emoji/svg?seed=' . fake()->word();
        $request->user()->childProfiles()->create($validated);
        return back()->with('success', 'Child profile added!');
    }

    /**
     * Switch the active child profile.
     */
    public function switchActive(Request $request)
    {
        $request->validate([
            'child_profile_id' => 'required|exists:child_profiles,id',
        ]);

        $child = $request->user()->childProfiles()->findOrFail($request->child_profile_id);
        session(['active_child_id' => $child->id]);

        return back();
    }

    /**
     * Display the specified child profile.
     */
    public function show(Request $request, ChildProfile $child)
    {
        if ($request->user()->id !== $child->user_id) {
            abort(403);
        }

        $child->load(['readingHistories.story' => function ($query) {
            $query->latest()->take(10);
        }]);

        return view('children.show', compact('child'));
    }

    /**
     * Increment the reading streak for a child profile.
     */
    public function incrementStreak(Request $request, ChildProfile $child)
    {
        if ($request->user()->id !== $child->user_id) {
            abort(403);
        }

        $child->increment('reading_streak');

        return response()->json([ 'reading_streak' => $child->reading_streak ]);
    }
}