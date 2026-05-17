@extends('layouts.app')
@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="text-center mb-16">
        <h1 class="text-5xl font-extrabold text-gray-900 font-poppins mb-4">The Magical Library 📖</h1>
        <p class="text-xl font-medium text-gray-600">Choose your next big adventure.</p>
    </div>

    <!-- Filters -->
    <div class="glass rounded-full p-2 mb-12 flex flex-wrap gap-2 justify-center shadow-md">
        <a href="{{ route('stories.index') }}" class="px-6 py-2 rounded-full font-bold text-sm {{ !request('category') ? 'bg-purple-600 text-white shadow' : 'text-gray-600 hover:bg-white' }} transition-colors">All Stories</a>
        @foreach($categories as $category)
            <a href="{{ route('stories.index', ['category' => $category->slug]) }}" class="px-6 py-2 rounded-full font-bold text-sm {{ request('category') === $category->slug ? 'bg-purple-600 text-white shadow' : 'text-gray-600 hover:bg-white' }} transition-colors">{{ $category->name }}</a>
        @endforeach
    </div>

    <!-- Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
        @foreach($stories as $story)
        <a href="{{ route('stories.show', $story) }}" class="bg-white rounded-3xl overflow-hidden shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 group border border-gray-100 flex flex-col h-full">
            <div class="relative h-56 overflow-hidden">
                <img src="{{ $story->cover_image }}" alt="{{ $story->title }}" class="object-cover w-full h-full group-hover:scale-110 transition-transform duration-700">
                <div class="absolute top-4 left-4 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-bold text-purple-700 shadow-sm">
                    {{ $story->category->name }}
                </div>
            </div>
            <div class="p-6 flex flex-col flex-grow">
                <h3 class="text-2xl font-bold text-gray-900 mb-2 font-poppins line-clamp-2">{{ $story->title }}</h3>
                <p class="text-gray-600 text-sm line-clamp-3 mb-4 flex-grow">{{ $story->description }}</p>
                <div class="flex items-center justify-between text-sm text-gray-500 font-semibold pt-4 border-t border-gray-100">
                    <span class="flex items-center gap-1">🧒 {{ $story->age_group }}</span>
                    <span class="flex items-center gap-1">⏱️ {{ $story->duration_minutes }}m</span>
                </div>
            </div>
        </a>
        @endforeach
    </div>

    <div class="mt-12 flex justify-center">
        {{ $stories->links() }}
    </div>
</div>
@endsection