@extends('layouts.app')
@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-extrabold text-gray-900 font-poppins">Manage Categories 🏷️</h1>
        <a href="{{ route('admin.dashboard') }}" class="text-purple-600 font-bold hover:underline">⬅️ Back to Dashboard</a>
    </div>

    @if(session('success'))
        <div class="mb-6 px-4 py-3 bg-green-100 border border-green-300 text-green-800 rounded-xl font-semibold">
            ✅ {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="mb-6 px-4 py-3 bg-red-100 border border-red-300 text-red-800 rounded-xl font-semibold">
            ❌ {{ session('error') }}
        </div>
    @endif

    {{-- Create Category Form --}}
    <div class="glass rounded-3xl p-8 shadow-xl border border-gray-100 mb-8">
        <h2 class="text-xl font-bold text-gray-800 mb-6 font-poppins">Add New Category</h2>
        <form action="{{ route('admin.categories.store') }}" method="POST" class="space-y-4">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Name <span class="text-red-500">*</span></label>
                    <input type="text" name="name" value="{{ old('name') }}" required
                           class="w-full rounded-xl border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500 py-3 px-4 bg-white/80"
                           placeholder="e.g. Fantasy">
                    @error('name')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Color</label>
                    <div class="flex items-center gap-3">
                        <input type="color" name="color" value="{{ old('color', '#8b5cf6') }}"
                               class="h-12 w-16 rounded-xl border-gray-300 shadow-sm cursor-pointer">
                        <span class="text-sm text-gray-500">Pick a display color for this category</span>
                    </div>
                </div>
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Description</label>
                <textarea name="description" rows="2"
                          class="w-full rounded-xl border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500 py-3 px-4 bg-white/80"
                          placeholder="Optional description">{{ old('description') }}</textarea>
            </div>
            <div class="pt-2">
                <button type="submit"
                        class="bg-purple-600 hover:bg-purple-500 text-white font-bold py-3 px-6 rounded-xl shadow transition-transform transform hover:-translate-y-1">
                    + Add Category
                </button>
            </div>
        </form>
    </div>

    {{-- Category List --}}
    <div class="bg-white rounded-3xl shadow-lg border border-gray-100 overflow-hidden">
        <div class="px-6 py-5 border-b border-gray-100 bg-gray-50">
            <h3 class="text-lg font-bold text-gray-900 font-poppins">All Categories ({{ $categories->count() }})</h3>
        </div>
        @forelse($categories as $category)
            <div class="px-6 py-4 border-b border-gray-100 last:border-0 hover:bg-gray-50 transition-colors">
                <div class="flex items-center justify-between gap-4">
                    <div class="flex items-center gap-4 flex-1">
                        <div class="w-5 h-5 rounded-full flex-shrink-0" style="background-color: {{ $category->color ?? '#8b5cf6' }}"></div>
                        <div>
                            <p class="font-bold text-gray-900">{{ $category->name }}</p>
                            <p class="text-xs text-gray-500">{{ $category->stories_count }} {{ Str::plural('story', $category->stories_count) }}</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-2">
                        <button onclick="document.getElementById('edit-{{ $category->id }}').classList.toggle('hidden')"
                                class="text-sm text-purple-600 hover:text-purple-800 font-semibold">✏️ Edit</button>

                        @if($category->stories_count === 0)
                            <form action="{{ route('admin.categories.destroy', $category) }}" method="POST"
                                  onsubmit="return confirm('Delete category \'{{ addslashes($category->name) }}\'?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-sm text-red-500 hover:text-red-700 font-semibold">🗑️ Delete</button>
                            </form>
                        @endif
                    </div>
                </div>

                {{-- Inline edit form --}}
                <div id="edit-{{ $category->id }}" class="hidden mt-4">
                    <form action="{{ route('admin.categories.update', $category) }}" method="POST" class="space-y-3">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                            <input type="text" name="name" value="{{ $category->name }}" required
                                   class="w-full rounded-xl border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500 py-2 px-3 bg-white text-sm">
                            <div class="flex items-center gap-3">
                                <input type="color" name="color" value="{{ $category->color ?? '#8b5cf6' }}"
                                       class="h-10 w-16 rounded-xl border-gray-300 shadow-sm cursor-pointer">
                                <span class="text-sm text-gray-500">Color</span>
                            </div>
                        </div>
                        <textarea name="description" rows="2"
                                  class="w-full rounded-xl border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500 py-2 px-3 bg-white text-sm">{{ $category->description }}</textarea>
                        <div class="flex gap-2">
                            <button type="submit" class="bg-purple-600 hover:bg-purple-500 text-white text-sm font-bold py-2 px-4 rounded-lg">Save</button>
                            <button type="button"
                                    onclick="document.getElementById('edit-{{ $category->id }}').classList.add('hidden')"
                                    class="bg-gray-200 hover:bg-gray-300 text-gray-700 text-sm font-bold py-2 px-4 rounded-lg">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        @empty
            <div class="px-6 py-12 text-center">
                <p class="text-gray-500 font-semibold">🏷️ No categories yet. Add your first one above!</p>
            </div>
        @endforelse
    </div>
</div>
@endsection
