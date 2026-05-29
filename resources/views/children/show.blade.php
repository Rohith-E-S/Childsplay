@extends('layouts.app')
@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12 bg-paper">
    <div class="mb-6">
        <a href="{{ route('dashboard') }}" class="text-indigo-900 font-bold text-sm hover:underline font-outfit">&larr; Back to Dashboard</a>
    </div>

    <div class="bg-white rounded-xl p-8 border border-stone-200 shadow-sm mb-8">
        <div class="flex items-center gap-6">
            <img src="{{ $child->avatar_url }}" alt="Avatar" class="w-24 h-24 rounded-full bg-stone-50 p-1 shadow-md border border-stone-250">
            <div>
                <h1 class="text-3xl font-extrabold text-stone-900 font-serif-book">{{ $child->name }}</h1>
                <p class="text-stone-500 font-medium text-sm font-outfit uppercase tracking-wider mt-1">Age {{ $child->age }} | {{ $child->reading_level }}</p>
                <div class="mt-3 inline-flex items-center gap-2 bg-amber-50 px-3 py-1 rounded-full border border-amber-200">
                    <span class="text-amber-500 text-lg">🔥</span>
                    <span class="text-amber-900 font-bold text-sm font-outfit">{{ $child->reading_streak ?? 0 }} Day Streak</span>
                </div>
            </div>
        </div>
    </div>

    <div class="mb-12">
        <h2 class="text-2xl font-bold text-stone-850 mb-6 font-serif-book">Reading History</h2>
        
        @if($child->readingHistories->count() > 0)
            <div class="bg-white rounded-xl border border-stone-200 shadow-sm overflow-hidden">
                <ul class="divide-y divide-stone-100">
                    @foreach($child->readingHistories as $history)
                    <li class="p-6 hover:bg-stone-50 transition-colors">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-lg font-bold text-indigo-900 font-serif-book">{{ $history->story->title }}</h3>
                                <p class="text-stone-500 text-sm font-outfit mt-1">Read on {{ $history->created_at->format('M j, Y') }}</p>
                            </div>
                            <a href="{{ route('stories.show', $history->story) }}" class="text-indigo-600 hover:text-indigo-900 font-bold text-sm font-outfit px-4 py-2 bg-indigo-50 rounded-lg hover:bg-indigo-100 transition-colors">Read Again</a>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        @else
            <div class="bg-white rounded-xl p-8 border border-stone-200 shadow-sm text-center">
                <p class="text-stone-500 font-outfit mb-4">No stories read yet. Time to start an adventure!</p>
                <a href="{{ route('stories.index') }}" class="bg-indigo-900 hover:bg-indigo-950 text-white font-bold py-2 px-6 rounded-lg transition-colors text-sm font-outfit inline-block">Browse Library</a>
            </div>
        @endif
    </div>
</div>
@endsection
