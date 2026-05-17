@extends('layouts.app')
@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="glass rounded-3xl p-8 shadow-xl border border-gray-100">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-extrabold text-gray-900 font-poppins">Add New Story 📚</h1>
            <a href="{{ route('admin.dashboard') }}" class="text-purple-600 font-bold hover:underline">⬅️ Back to Dashboard</a>
        </div>
        
        <form action="{{ route('admin.stories.store') }}" method="POST" class="space-y-6">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Title</label>
                    <input type="text" name="title" value="{{ old('title') }}" required class="w-full rounded-xl border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500 py-3 px-4 bg-white/80">
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Slug</label>
                    <input type="text" name="slug" value="{{ old('slug') }}" required class="w-full rounded-xl border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500 py-3 px-4 bg-white/80">
                </div>
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Description</label>
                <textarea name="description" rows="4" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500 py-3 px-4 bg-white/80">{{ old('description') }}</textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Cover Image URL</label>
                    <input type="url" name="cover_image" value="{{ old('cover_image') }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500 py-3 px-4 bg-white/80">
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Author</label>
                    <input type="text" name="author" value="{{ old('author') }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500 py-3 px-4 bg-white/80">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Category</label>
                    <select name="category_id" required class="w-full rounded-xl border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500 py-3 px-4 bg-white/80">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Age Group</label>
                    <input type="text" name="age_group" value="{{ old('age_group') }}" placeholder="e.g. 3-5" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500 py-3 px-4 bg-white/80">
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Duration (mins)</label>
                    <input type="number" name="duration_minutes" value="{{ old('duration_minutes') }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500 py-3 px-4 bg-white/80">
                </div>
            </div>

            <div class="flex items-center gap-3 mt-4 bg-white/50 p-4 rounded-xl border border-gray-200">
                <input type="checkbox" name="is_published" id="is_published" value="1" class="w-5 h-5 text-purple-600 border-gray-300 rounded focus:ring-purple-500">
                <label for="is_published" class="text-sm font-bold text-gray-800">Publish immediately</label>
            </div>

            <div class="pt-6">
                <button type="submit" class="w-full bg-purple-600 hover:bg-purple-500 text-white font-bold py-4 px-6 rounded-xl shadow-lg transition-transform transform hover:-translate-y-1 text-lg">
                    Create Story ✨
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
