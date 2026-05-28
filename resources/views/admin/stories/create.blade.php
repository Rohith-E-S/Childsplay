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
                <div x-data="categoryCreator()">
                    <div class="flex items-center justify-between mb-2">
                        <label class="block text-sm font-bold text-gray-700">Category</label>
                        <button type="button" @click="toggle"
                                class="text-xs font-bold text-purple-600 hover:text-purple-800 flex items-center gap-1">
                            <span x-text="open ? '✕ Cancel' : '+ New'"></span>
                        </button>
                    </div>

                    <select id="category_id" name="category_id" required
                            class="w-full rounded-xl border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500 py-3 px-4 bg-white/80">
                        <option value="" disabled selected>Select a category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>

                    {{-- Inline quick-create form --}}
                    <div x-show="open" x-transition class="mt-3 p-4 bg-purple-50 border border-purple-200 rounded-xl space-y-3">
                        <p class="text-xs font-bold text-purple-700 uppercase tracking-wide">Quick Create Category</p>
                        <div class="flex gap-2">
                            <input type="text" x-model="name" placeholder="Category name"
                                   @keydown.enter.prevent="submit"
                                   class="flex-1 rounded-xl border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500 py-2 px-3 text-sm bg-white">
                            <input type="color" x-model="color" title="Pick a color"
                                   class="h-10 w-12 rounded-xl border-gray-300 shadow-sm cursor-pointer">
                        </div>
                        <p x-show="error" x-text="error" class="text-xs text-red-600 font-semibold"></p>
                        <button type="button" @click="submit" :disabled="loading"
                                class="bg-purple-600 hover:bg-purple-500 disabled:opacity-50 text-white text-sm font-bold py-2 px-4 rounded-lg transition">
                            <span x-text="loading ? 'Creating...' : 'Create & Select'"></span>
                        </button>
                    </div>
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

        <p class="text-center text-gray-600 text-sm mt-4">After creating, you'll be taken to add story pages</p>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('categoryCreator', () => ({
        open: false,
        name: '',
        color: '#8b5cf6',
        loading: false,
        error: '',
        toggle() {
            this.open = !this.open;
            this.error = '';
            this.name = '';
        },
        async submit() {
            this.error = '';
            if (!this.name.trim()) {
                this.error = 'Category name is required.';
                return;
            }
            this.loading = true;
            try {
                const response = await fetch('{{ route('admin.categories.store') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    },
                    body: JSON.stringify({ name: this.name.trim(), color: this.color }),
                });
                const data = await response.json();
                if (!response.ok) {
                    this.error = data.errors?.name?.[0] ?? 'Failed to create category.';
                    return;
                }
                const select = document.getElementById('category_id');
                const option = new Option(data.name, data.id, true, true);
                select.add(option);
                select.value = data.id;
                this.open = false;
                this.name = '';
            } catch {
                this.error = 'Something went wrong. Please try again.';
            } finally {
                this.loading = false;
            }
        },
    }));
});
</script>
@endpush
