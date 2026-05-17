@extends('layouts.app')
@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="glass rounded-[3rem] overflow-hidden shadow-2xl">
        <div class="relative h-96">
            <img src="{{ $story->cover_image }}" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-t from-gray-900/80 to-transparent"></div>
            <div class="absolute bottom-0 left-0 p-8 text-white w-full">
                <span class="inline-block px-4 py-1 bg-purple-500/80 backdrop-blur-md rounded-full text-sm font-bold mb-4 shadow-lg">{{ $story->category->name }}</span>
                <h1 class="text-5xl font-extrabold font-poppins mb-2 text-shadow">{{ $story->title }}</h1>
                <p class="text-lg font-medium text-gray-200">By {{ $story->author }}</p>
            </div>
        </div>
        <div class="p-8 sm:p-12 bg-white/80 backdrop-blur-lg">
            <div class="flex flex-wrap gap-6 mb-8 pb-8 border-b border-gray-200">
                <div class="flex flex-col items-center p-4 bg-purple-50 rounded-2xl min-w-[120px]">
                    <span class="text-3xl mb-1">👶</span>
                    <span class="text-xs text-gray-500 uppercase font-bold tracking-wider">Ages</span>
                    <span class="font-bold text-gray-900">{{ $story->age_group }}</span>
                </div>
                <div class="flex flex-col items-center p-4 bg-blue-50 rounded-2xl min-w-[120px]">
                    <span class="text-3xl mb-1">⏱️</span>
                    <span class="text-xs text-gray-500 uppercase font-bold tracking-wider">Duration</span>
                    <span class="font-bold text-gray-900">{{ $story->duration_minutes }} min</span>
                </div>
                <div class="flex flex-col items-center p-4 bg-green-50 rounded-2xl min-w-[120px]">
                    <span class="text-3xl mb-1">📚</span>
                    <span class="text-xs text-gray-500 uppercase font-bold tracking-wider">Level</span>
                    <span class="font-bold text-gray-900">{{ $story->reading_level }}</span>
                </div>
            </div>
            <div class="prose prose-lg text-gray-600 font-medium mb-12 max-w-none">
                {{ $story->description }}
            </div>
            <div class="flex justify-center">
                <a href="{{ route('stories.read', $story) }}" class="bg-gradient-to-r from-purple-600 to-pink-500 hover:from-purple-500 hover:to-pink-400 text-white font-bold py-5 px-12 rounded-full shadow-xl hover:shadow-2xl transition-all transform hover:-translate-y-2 text-2xl font-poppins flex items-center gap-3">
                    📖 Start Reading
                </a>
            </div>
        </div>
    </div>
</div>
@endsection