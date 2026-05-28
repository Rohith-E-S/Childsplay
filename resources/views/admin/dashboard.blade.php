@extends('layouts.app')
@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 bg-paper font-outfit">
    <h1 class="text-3xl font-extrabold text-stone-900 font-serif-book mb-8 border-b border-book pb-4">Admin Dashboard</h1>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
        <div class="bg-white rounded-lg p-6 shadow-sm border border-stone-200/80 flex items-center gap-6">
            <div class="bg-stone-50 text-stone-700 text-3xl p-3.5 rounded-lg border border-stone-200/50 shadow-inner">👥</div>
            <div>
                <p class="text-stone-400 font-bold uppercase text-xs tracking-wider">Total Users</p>
                <p class="text-2xl font-extrabold text-stone-900">{{ $stats['users'] }}</p>
            </div>
        </div>
        <div class="bg-white rounded-lg p-6 shadow-sm border border-stone-200/80 flex items-center gap-6">
            <div class="bg-stone-50 text-stone-700 text-3xl p-3.5 rounded-lg border border-stone-200/50 shadow-inner">📚</div>
            <div>
                <p class="text-stone-400 font-bold uppercase text-xs tracking-wider">Total Stories</p>
                <p class="text-2xl font-extrabold text-stone-900">{{ $stats['stories'] }}</p>
            </div>
        </div>
        <div class="bg-white rounded-lg p-6 shadow-sm border border-stone-200/80 flex items-center gap-6">
            <div class="bg-stone-50 text-stone-700 text-3xl p-3.5 rounded-lg border border-stone-200/50 shadow-inner">🏷️</div>
            <div>
                <p class="text-stone-400 font-bold uppercase text-xs tracking-wider">Categories</p>
                <p class="text-2xl font-extrabold text-stone-900">{{ $stats['categories'] }}</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-sm border border-stone-200/80 overflow-hidden">
        <div class="px-6 py-4 border-b border-stone-200 bg-stone-50/50 flex justify-between items-center">
            <h3 class="text-base font-bold text-stone-900 font-serif-book">All Stories ({{ count($stories) }})</h3>
            <div class="flex gap-2">
                <a href="{{ route('admin.categories.index') }}" class="px-4 py-2 bg-stone-100 hover:bg-stone-200 text-stone-700 text-xs font-bold rounded-lg border border-stone-200 shadow-sm transition-colors">Categories</a>
                <a href="{{ route('admin.stories.create') }}" class="px-4 py-2 bg-indigo-900 hover:bg-indigo-950 text-white text-xs font-bold rounded-lg shadow-sm transition-colors">+ Add Story</a>
            </div>
        </div>
        <div class="divide-y divide-stone-150">
            @forelse($stories as $story)
            <div class="px-6 py-4 flex items-center justify-between hover:bg-stone-50/50 transition-colors">
                <div class="flex items-center gap-4 flex-1">
                    <img src="{{ $story->cover_image }}" class="w-14 h-10 rounded border border-stone-200 object-cover shadow-sm">
                    <div class="flex-1">
                        <p class="text-sm font-bold text-stone-900 font-serif-book">{{ $story->title }}</p>
                        <p class="text-xs text-stone-500">{{ $story->author }} • {{ $story->category->name }}</p>
                    </div>
                </div>
                <div class="flex gap-3 items-center">
                    <span class="px-2.5 py-0.5 text-xs font-bold rounded {{ $story->is_published ? 'bg-emerald-50 text-emerald-800 border border-emerald-250/50' : 'bg-stone-100 text-stone-600 border border-stone-250/55' }} border">
                        {{ $story->is_published ? 'Published' : 'Draft' }}
                    </span>
                    <a href="{{ route('admin.stories.pages.manage', $story) }}" class="text-indigo-900 hover:text-indigo-950 font-bold text-xs transition-colors">Pages</a>
                    <a href="{{ route('admin.stories.edit', $story) }}" class="text-stone-400 hover:text-stone-700 font-bold text-xs transition-colors">Edit</a>
                </div>
            </div>
            @empty
            <div class="px-6 py-12 text-center">
                <p class="text-stone-500 font-semibold mb-4">No stories yet</p>
                <a href="{{ route('admin.stories.create') }}" class="px-4 py-2 bg-indigo-900 hover:bg-indigo-950 text-white text-xs font-bold rounded-lg shadow-sm transition-colors inline-block">Create Your First Story</a>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection