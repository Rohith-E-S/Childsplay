@extends('layouts.app')
@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <h1 class="text-4xl font-extrabold text-gray-900 font-poppins mb-8">Admin Dashboard ⚙️</h1>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
        <div class="bg-white rounded-3xl p-6 shadow-lg border border-purple-100 flex items-center gap-6">
            <div class="bg-purple-100 text-purple-600 text-4xl p-4 rounded-2xl">👥</div>
            <div>
                <p class="text-gray-500 font-bold uppercase text-sm">Total Users</p>
                <p class="text-3xl font-extrabold text-gray-900">{{ $stats['users'] }}</p>
            </div>
        </div>
        <div class="bg-white rounded-3xl p-6 shadow-lg border border-pink-100 flex items-center gap-6">
            <div class="bg-pink-100 text-pink-600 text-4xl p-4 rounded-2xl">📚</div>
            <div>
                <p class="text-gray-500 font-bold uppercase text-sm">Total Stories</p>
                <p class="text-3xl font-extrabold text-gray-900">{{ $stats['stories'] }}</p>
            </div>
        </div>
        <div class="bg-white rounded-3xl p-6 shadow-lg border border-blue-100 flex items-center gap-6">
            <div class="bg-blue-100 text-blue-600 text-4xl p-4 rounded-2xl">🏷️</div>
            <div>
                <p class="text-gray-500 font-bold uppercase text-sm">Categories</p>
                <p class="text-3xl font-extrabold text-gray-900">{{ $stats['categories'] }}</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-3xl shadow-lg border border-gray-100 overflow-hidden">
        <div class="px-6 py-5 border-b border-gray-100 bg-gray-50 flex justify-between items-center">
            <h3 class="text-lg font-bold text-gray-900 font-poppins">Recent Stories</h3>
            <a href="{{ route('admin.stories.create') }}" class="px-4 py-2 bg-purple-600 text-white text-sm font-bold rounded-lg hover:bg-purple-500 shadow transition-colors">+ Add Story</a>
        </div>
        <div class="divide-y divide-gray-100">
            @foreach($recentStories as $story)
            <div class="px-6 py-4 flex items-center justify-between hover:bg-gray-50 transition-colors">
                <div class="flex items-center gap-4">
                    <img src="{{ $story->cover_image }}" class="w-16 h-12 rounded object-cover shadow-sm">
                    <div>
                        <p class="text-sm font-bold text-gray-900">{{ $story->title }}</p>
                        <p class="text-xs text-gray-500">{{ $story->author }}</p>
                    </div>
                </div>
                <div class="flex gap-2 items-center">
                    <span class="px-3 py-1 text-xs font-bold rounded-full {{ $story->is_published ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-700' }}">
                        {{ $story->is_published ? 'Published' : 'Draft' }}
                    </span>
                    <a href="{{ route('admin.stories.edit', $story) }}" class="text-gray-400 hover:text-purple-600 font-medium text-sm transition-colors ml-4">Edit</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection