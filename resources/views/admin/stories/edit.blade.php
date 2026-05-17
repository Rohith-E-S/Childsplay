@extends('layouts.app')
@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="glass rounded-3xl p-8 shadow-xl border border-gray-100">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-extrabold text-gray-900 font-poppins">Edit Story ✍️</h1>
            <a href="{{ route('admin.dashboard') }}" class="text-purple-600 font-bold hover:underline">⬅️ Back to Dashboard</a>
        </div>
        
        <form action="{{ route('admin.stories.update', $story) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Title</label>
                    <input type="text" name="title" value="{{ old('title', $story->title) }}" required class="w-full rounded-xl border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500 py-3 px-4 bg-white/80">
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Slug</label>
                    <input type="text" name="slug" value="{{ old('slug', $story->slug) }}" required class="w-full rounded-xl border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500 py-3 px-4 bg-white/80">
                </div>
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Description</label>
                <textarea name="description" rows="4" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500 py-3 px-4 bg-white/80">{{ old('description', $story->description) }}</textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Cover Image URL</label>
                    <input type="url" name="cover_image" value="{{ old('cover_image', $story->cover_image) }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500 py-3 px-4 bg-white/80">
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Author</label>
                    <input type="text" name="author" value="{{ old('author', $story->author) }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500 py-3 px-4 bg-white/80">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Category</label>
                    <select name="category_id" required class="w-full rounded-xl border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500 py-3 px-4 bg-white/80">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ $story->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Age Group</label>
                    <input type="text" name="age_group" value="{{ old('age_group', $story->age_group) }}" placeholder="e.g. 3-5" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500 py-3 px-4 bg-white/80">
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Duration (mins)</label>
                    <input type="number" name="duration_minutes" value="{{ old('duration_minutes', $story->duration_minutes) }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500 py-3 px-4 bg-white/80">
                </div>
            </div>

            <div class="flex items-center gap-3 mt-4 bg-white/50 p-4 rounded-xl border border-gray-200">
                <input type="checkbox" name="is_published" id="is_published" value="1" {{ $story->is_published ? 'checked' : '' }} class="w-5 h-5 text-purple-600 border-gray-300 rounded focus:ring-purple-500">
                <label for="is_published" class="text-sm font-bold text-gray-800">Published</label>
            </div>

            <div class="pt-6">
                <button type="submit" class="w-full bg-purple-600 hover:bg-purple-500 text-white font-bold py-4 px-6 rounded-xl shadow-lg transition-transform transform hover:-translate-y-1 text-lg">
                    Save Changes 💾
                </button>
            </div>
        </form>

        <div class="mt-4 pt-4 border-t border-gray-300">
            <a href="{{ route('admin.stories.pages.manage', $story) }}" class="block w-full text-center px-4 py-3 bg-blue-600 hover:bg-blue-500 text-white font-bold rounded-xl shadow-md transition-all">
                📖 Manage Story Pages
            </a>
        </div>
        
        <form action="{{ route('admin.stories.destroy', $story) }}" method="POST" class="mt-4 text-center">
            @csrf
            @method('DELETE')
            <button type="submit" onclick="return confirm('Are you sure you want to delete this story? This cannot be undone.')" class="text-red-500 font-bold hover:text-red-700 underline text-sm">
                Delete Story
            </button>
        </form>
    </div>
</div>
@endsection
