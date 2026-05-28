@extends('layouts.app')
@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12 bg-paper">
    <a href="{{ route('stories.index') }}" class="inline-flex items-center text-sm font-semibold text-stone-500 hover:text-stone-900 mb-8 transition-colors font-outfit">
        ← Back to Library
    </a>

    <div class="bg-white rounded-xl border border-stone-200/70 p-8 sm:p-12 shadow-sm">
        <div class="grid grid-cols-1 md:grid-cols-10 gap-10 lg:gap-16">
            
            <!-- Book Cover Column -->
            <div class="md:col-span-4 flex justify-center items-start">
                <div class="relative w-full max-w-[280px] sm:max-w-[320px] aspect-[3/4] bg-stone-100 rounded-lg shadow-md overflow-hidden border border-stone-200/80 group">
                    <!-- Spine Shadow for Physical Book Effect -->
                    <div class="absolute inset-y-0 left-0 w-3 bg-gradient-to-r from-black/15 via-black/5 to-transparent z-10"></div>
                    <img src="{{ $story->cover_image }}" class="w-full h-full object-cover group-hover:scale-[1.01] transition-transform duration-500">
                </div>
            </div>

            <!-- Story Info Column -->
            <div class="md:col-span-6 flex flex-col justify-between">
                <div>
                    <span class="inline-block px-2.5 py-0.5 bg-stone-100 text-stone-700 rounded text-xs font-bold mb-4 font-outfit uppercase tracking-wider">{{ $story->category->name }}</span>
                    <h1 class="text-3xl sm:text-4xl font-extrabold font-serif-book text-stone-900 leading-tight mb-2">{{ $story->title }}</h1>
                    <p class="text-base font-semibold text-stone-500 font-outfit mb-8">Written by {{ $story->author }}</p>

                    <!-- Story Specifications -->
                    <div class="grid grid-cols-3 gap-4 border-y border-stone-200 py-6 mb-8 font-outfit text-center">
                        <div>
                            <span class="block text-xs font-bold text-stone-400 uppercase tracking-wider mb-1">Ages</span>
                            <span class="text-lg font-bold text-stone-850">{{ $story->age_group }}</span>
                        </div>
                        <div>
                            <span class="block text-xs font-bold text-stone-400 uppercase tracking-wider mb-1">Duration</span>
                            <span class="text-lg font-bold text-stone-850">{{ $story->duration_minutes }} min</span>
                        </div>
                        <div>
                            <span class="block text-xs font-bold text-stone-400 uppercase tracking-wider mb-1">Level</span>
                            <span class="text-lg font-bold text-stone-850 text-ellipsis overflow-hidden block whitespace-nowrap">{{ $story->reading_level }}</span>
                        </div>
                    </div>

                    <!-- Story Description -->
                    <div class="text-stone-600 font-serif-book text-base leading-relaxed mb-8 max-w-none">
                        {{ $story->description }}
                    </div>
                </div>

                <div class="pt-4">
                    <a href="{{ route('stories.read', $story) }}" class="bg-indigo-900 hover:bg-indigo-950 text-white font-bold py-3.5 px-8 rounded-lg shadow-sm transition-colors text-base font-outfit inline-flex items-center gap-2 justify-center w-full sm:w-auto">
                        Start Reading
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection