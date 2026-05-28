@extends('layouts.app')
@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 bg-paper">
    <div class="text-center mb-12">
        <h1 class="text-4xl font-extrabold text-stone-900 font-serif-book mb-3">The Story Library</h1>
        <p class="text-lg font-medium text-stone-600 font-outfit">Explore classic illustrated stories curated for early reading levels.</p>
    </div>

    <!-- Filters -->
    <div class="flex flex-wrap gap-2 justify-center mb-12 border-b border-book pb-4 font-outfit">
        <a href="{{ route('stories.index') }}" class="px-5 py-2 rounded-lg font-bold text-sm transition-colors {{ !request('category') ? 'bg-indigo-900 text-white shadow-sm' : 'text-stone-600 hover:text-stone-900 hover:bg-stone-100' }}">All Stories</a>
        @foreach($categories as $category)
            <a href="{{ route('stories.index', ['category' => $category->slug]) }}" class="px-5 py-2 rounded-lg font-bold text-sm transition-colors {{ request('category') === $category->slug ? 'bg-indigo-900 text-white shadow-sm' : 'text-stone-600 hover:text-stone-900 hover:bg-stone-100' }}">{{ $category->name }}</a>
        @endforeach
    </div>

    <!-- Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
        @foreach($stories as $story)
        <a href="{{ route('stories.show', $story) }}" class="bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-md border border-stone-200/70 transition-all duration-300 group flex flex-col h-full">
            <div class="relative h-56 overflow-hidden bg-stone-100 border-b border-stone-100">
                <img src="{{ $story->cover_image }}" alt="{{ $story->title }}" class="object-cover w-full h-full group-hover:scale-[1.02] transition-transform duration-500">
                <div class="absolute top-4 left-4 bg-white/95 px-2.5 py-0.5 rounded text-xs font-bold text-stone-700 shadow-sm border border-stone-100 font-outfit">
                    {{ $story->category->name }}
                </div>
            </div>
            <div class="p-5 flex flex-col flex-grow">
                <h3 class="text-xl font-bold text-stone-900 mb-2 font-serif-book line-clamp-2">{{ $story->title }}</h3>
                <p class="text-stone-500 text-sm line-clamp-3 mb-4 flex-grow font-outfit">{{ $story->description }}</p>
                <div class="flex items-center justify-between text-xs text-stone-500 font-semibold pt-4 border-t border-stone-100 font-outfit">
                    <span>Ages {{ $story->age_group }}</span>
                    <span>{{ $story->duration_minutes }} min read</span>
                </div>
            </div>
        </a>
        @endforeach
    </div>

    <div class="mt-12 flex justify-center font-outfit">
        {{ $stories->links() }}
    </div>
</div>
@endsection