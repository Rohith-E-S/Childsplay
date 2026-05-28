@extends('layouts.app')
@section('content')
<div class="relative bg-paper">
    <!-- Hero Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-20 pb-20 text-center lg:pt-28">
        <h1 class="mx-auto max-w-4xl font-serif-book text-5xl font-extrabold tracking-tight text-stone-900 sm:text-7xl">
            Where <span class="text-indigo-900 italic">Imagination</span> Takes Flight
        </h1>
        <p class="mx-auto mt-6 max-w-2xl text-lg sm:text-xl tracking-tight text-stone-600 font-outfit">
            Classic digital stories, beautifully crafted to inspire curiosity, wonder, and a lifelong love for reading.
        </p>
        <div class="mt-10 flex justify-center gap-x-4">
            <a href="{{ route('register') }}" class="inline-flex items-center justify-center rounded-lg py-3.5 px-8 text-base font-bold text-white bg-indigo-900 hover:bg-indigo-950 shadow-sm transition-colors font-outfit">
                Start the Adventure
            </a>
            <a href="{{ route('stories.index') }}" class="inline-flex items-center justify-center rounded-lg py-3.5 px-8 text-base font-bold text-stone-700 bg-white hover:bg-stone-50 border border-stone-200 shadow-sm transition-colors font-outfit">
                Browse Library
            </a>
        </div>
    </div>
</div>

<!-- Featured Stories -->
<div class="py-16 bg-[#FAF8F5] border-t border-book">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-extrabold text-stone-950 mb-10 font-serif-book tracking-tight">
            Featured Stories
        </h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach($trendingStories as $story)
            <a href="{{ route('stories.show', $story) }}" class="bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-md border border-stone-200/70 transition-all duration-300 group flex flex-col h-full">
                <div class="aspect-w-4 aspect-h-3 bg-stone-100 overflow-hidden border-b border-stone-100">
                    <img src="{{ $story->cover_image }}" alt="{{ $story->title }}" class="object-cover w-full h-48 group-hover:scale-[1.02] transition-transform duration-500">
                </div>
                <div class="p-5 flex flex-col flex-grow">
                    <span class="inline-block px-2.5 py-0.5 bg-stone-100 text-stone-700 rounded text-xs font-semibold mb-3 self-start font-outfit">{{ $story->category->name }}</span>
                    <h3 class="text-lg font-bold text-stone-900 mb-2 font-serif-book line-clamp-2 flex-grow">{{ $story->title }}</h3>
                    <p class="text-stone-500 text-sm line-clamp-2 mb-4 font-outfit">{{ $story->description }}</p>
                    <div class="flex items-center justify-between text-xs text-stone-500 font-semibold pt-3 border-t border-stone-100 font-outfit">
                        <span>Ages {{ $story->age_group }}</span>
                        <span>{{ $story->duration_minutes }} min read</span>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</div>
@endsection