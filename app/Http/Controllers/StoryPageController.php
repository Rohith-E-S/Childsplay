<?php

namespace App\Http\Controllers;

use App\Models\Story;
use App\Models\StoryPage;
use Illuminate\Http\Request;

class StoryPageController extends Controller
{
    public function manage(Story $story)
    {
        $story->load('pages');
        $pages = $story->pages()->orderBy('page_number')->get();

        return view('admin.stories.pages', compact('story', 'pages'));
    }

    public function store(Request $request, Story $story)
    {
        $validated = $request->validate([
            'page_number' => 'required|integer|min:1',
            'image_url' => 'nullable|url',
            'content' => 'nullable|string',
        ]);

        $pageExists = StoryPage::where('story_id', $story->id)
            ->where('page_number', $validated['page_number'])
            ->exists();

        if ($pageExists) {
            return back()->with('error', 'A page with this number already exists. Delete it first or use a different number.');
        }

        StoryPage::create(array_merge($validated, ['story_id' => $story->id]));

        return back()->with('success', 'Page added successfully! Add more pages or publish your story.');
    }

    public function update(Request $request, Story $story, StoryPage $page)
    {
        if ($page->story_id !== $story->id) {
            abort(403, 'Unauthorized');
        }

        $validated = $request->validate([
            'page_number' => 'required|integer|min:1',
            'image_url' => 'nullable|url',
            'content' => 'nullable|string',
        ]);

        $pageNumberExists = StoryPage::where('story_id', $story->id)
            ->where('page_number', $validated['page_number'])
            ->where('id', '!=', $page->id)
            ->exists();

        if ($pageNumberExists) {
            return back()->with('error', 'Another page already has this number.');
        }

        $page->update($validated);

        return back()->with('success', 'Page updated successfully!');
    }

    public function destroy(Story $story, StoryPage $page)
    {
        if ($page->story_id !== $story->id) {
            abort(403, 'Unauthorized');
        }

        $page->delete();

        // Reorder remaining pages
        $story->pages()->orderBy('page_number')->get()->each(fn ($p, $index) => $p->update(['page_number' => $index + 1]));

        return back()->with('success', 'Page deleted successfully!');
    }

    public function reorder(Request $request, Story $story)
    {
        $validated = $request->validate([
            'pages' => 'required|array',
            'pages.*' => 'required|integer',
        ]);

        foreach ($validated['pages'] as $index => $pageId) {
            StoryPage::where('id', $pageId)
                ->where('story_id', $story->id)
                ->update(['page_number' => $index + 1]);
        }

        return response()->json(['success' => true, 'message' => 'Pages reordered successfully!']);
    }
}
