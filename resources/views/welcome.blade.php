@extends('layouts.app')
@section('content')
<div class="relative overflow-hidden">
    <!-- Hero Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-20 pb-24 text-center lg:pt-32">
        <h1 class="mx-auto max-w-4xl font-display text-5xl font-extrabold tracking-tight text-gray-900 sm:text-7xl">
            Where <span class="text-transparent bg-clip-text bg-gradient-to-r from-purple-600 to-pink-500">Imagination</span> Takes Flight
        </h1>
        <p class="mx-auto mt-6 max-w-2xl text-xl tracking-tight text-gray-700">
            Interactive, beautifully animated stories that make reading the most magical part of your child's day.
        </p>
        <div class="mt-10 flex justify-center gap-x-6">
            <a href="{{ route('register') }}" class="group inline-flex items-center justify-center rounded-full py-4 px-8 text-lg font-bold text-white bg-purple-600 hover:bg-purple-500 shadow-xl hover:shadow-2xl transition-all hover:-translate-y-1">
                Start the Adventure 🚀
            </a>
            <a href="{{ route('stories.index') }}" class="group inline-flex items-center justify-center rounded-full py-4 px-8 text-lg font-bold text-purple-600 bg-white/50 hover:bg-white shadow-md hover:shadow-lg border border-purple-100 transition-all hover:-translate-y-1">
                Explore Library 📚
            </a>
        </div>
    </div>
</div>

<!-- Trending Stories -->
<div class="py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-4xl font-extrabold text-gray-900 mb-8 font-poppins flex items-center gap-3">
            🔥 Trending Stories
        </h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach($trendingStories as $story)
            <a href="{{ route('stories.show', $story) }}" class="glass rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 group block">
                <div class="aspect-w-4 aspect-h-3 bg-gray-200">
                    <img src="{{ $story->cover_image }}" alt="{{ $story->title }}" class="object-cover w-full h-48 group-hover:scale-105 transition-transform duration-500">
                </div>
                <div class="p-6">
                    <span class="inline-block px-3 py-1 bg-purple-100 text-purple-600 rounded-full text-xs font-bold mb-3">{{ $story->category->name }}</span>
                    <h3 class="text-xl font-bold text-gray-900 mb-2 font-poppins line-clamp-2">{{ $story->title }}</h3>
                    <p class="text-gray-600 text-sm line-clamp-2 mb-4">{{ $story->description }}</p>
                    <div class="flex items-center justify-between text-sm text-gray-500 font-semibold">
                        <span>🧒 {{ $story->age_group }} yrs</span>
                        <span>⏱️ {{ $story->duration_minutes }} min</span>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</div>
@endsection