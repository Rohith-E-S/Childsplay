@extends('layouts.app')
@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-4xl font-extrabold text-gray-900 font-poppins">📖 {{ $story->title }}</h1>
            <p class="text-gray-600 mt-2">Manage story pages for <span class="font-bold">{{ $story->category->name }}</span> | {{ $story->age_group }} years</p>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('admin.stories.edit', $story) }}" class="px-4 py-2 bg-gray-500 text-white font-bold rounded-lg hover:bg-gray-600 transition-colors">✏️ Edit Details</a>
            <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 bg-purple-600 text-white font-bold rounded-lg hover:bg-purple-500 transition-colors">← Back</a>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg font-semibold">
            ✅ {{ $message }}
        </div>
    @endif

    @if ($message = Session::get('error'))
        <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg font-semibold">
            ❌ {{ $message }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Left: Add Page Form -->
        <div class="lg:col-span-1">
            <div class="glass rounded-3xl p-6 shadow-xl border border-gray-100 sticky top-20">
                <h2 class="text-2xl font-bold text-gray-900 mb-6 font-poppins">➕ Add New Page</h2>
                
                <form action="{{ route('admin.stories.pages.store', $story) }}" method="POST" class="space-y-4">
                    @csrf
                    
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Page Number</label>
                        <input type="number" name="page_number" value="{{ $pages->count() + 1 }}" min="1" required class="w-full rounded-lg border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500 py-2 px-3 bg-white/80">
                        <p class="text-xs text-gray-500 mt-1">Current pages: {{ $pages->count() }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">📸 Image URL</label>
                        <input type="url" name="image_url" placeholder="https://example.com/image.jpg" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500 py-2 px-3 bg-white/80">
                        <p class="text-xs text-gray-500 mt-1">Optional - leave empty for text-only</p>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">📝 Page Content</label>
                        <textarea name="content" rows="5" placeholder="Write the story text for this page..." class="w-full rounded-lg border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500 py-2 px-3 bg-white/80"></textarea>
                    </div>

                    <button type="submit" class="w-full bg-purple-600 hover:bg-purple-500 text-white font-bold py-3 px-4 rounded-lg shadow-md transition-all transform hover:-translate-y-1">
                        ✨ Add Page
                    </button>
                </form>

                <!-- Page Count Stats -->
                <div class="mt-8 pt-6 border-t border-gray-200">
                    <div class="text-center">
                        <p class="text-4xl font-bold text-purple-600">{{ $pages->count() }}</p>
                        <p class="text-sm text-gray-600 font-semibold">{{ $pages->count() === 1 ? 'Page' : 'Pages' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right: Pages List -->
        <div class="lg:col-span-2">
            <div class="space-y-4">
                @forelse($pages as $page)
                    <div class="glass rounded-2xl p-6 border-l-4 border-purple-500 shadow-lg hover:shadow-xl transition-shadow" id="page-{{ $page->id }}">
                        <div class="flex justify-between items-start gap-4 mb-4">
                            <div class="flex items-start gap-4 flex-1">
                                <div class="flex-shrink-0">
                                    <div class="flex items-center justify-center h-12 w-12 rounded-full bg-purple-100 text-purple-600 font-bold">
                                        {{ $page->page_number }}
                                    </div>
                                </div>
                                <div class="flex-1">
                                    @if($page->image_url)
                                        <div class="mb-3 rounded-lg overflow-hidden h-32 bg-gray-200">
                                            <img src="{{ $page->image_url }}" alt="Page {{ $page->page_number }}" class="w-full h-full object-cover hover:scale-105 transition-transform cursor-pointer" onclick="document.getElementById('img-modal-{{ $page->id }}').classList.remove('hidden')">
                                        </div>
                                    @else
                                        <div class="mb-3 rounded-lg overflow-hidden h-20 bg-gradient-to-r from-purple-100 to-pink-100 flex items-center justify-center">
                                            <p class="text-gray-400 text-sm font-semibold">No image</p>
                                        </div>
                                    @endif
                                    
                                    @if($page->content)
                                        <p class="text-gray-700 text-sm line-clamp-3 font-medium">{{ $page->content }}</p>
                                    @else
                                        <p class="text-gray-400 text-sm italic">No text content</p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="flex gap-2 pt-4 border-t border-gray-200">
                            <button type="button" onclick="document.getElementById('edit-modal-{{ $page->id }}').classList.remove('hidden')" class="flex-1 px-3 py-2 bg-blue-100 hover:bg-blue-200 text-blue-700 font-bold rounded-lg transition-colors text-sm">
                                ✏️ Edit
                            </button>
                            <form action="{{ route('admin.stories.pages.destroy', [$story, $page]) }}" method="POST" class="flex-1">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Delete this page? This cannot be undone.')" class="w-full px-3 py-2 bg-red-100 hover:bg-red-200 text-red-700 font-bold rounded-lg transition-colors text-sm">
                                    🗑️ Delete
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Edit Modal -->
                    <div id="edit-modal-{{ $page->id }}" class="hidden fixed inset-0 z-50 bg-gray-900/50 backdrop-blur-sm flex justify-center items-center p-4">
                        <div class="bg-white rounded-3xl p-8 max-w-2xl w-full shadow-2xl border-4 border-purple-200 max-h-[90vh] overflow-y-auto">
                            <h3 class="text-2xl font-bold mb-6 text-gray-900 font-poppins">Edit Page {{ $page->page_number }}</h3>
                            
                            <form action="{{ route('admin.stories.pages.update', [$story, $page]) }}" method="POST" class="space-y-4">
                                @csrf
                                @method('PUT')
                                
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-2">Page Number</label>
                                    <input type="number" name="page_number" value="{{ $page->page_number }}" min="1" required class="w-full rounded-lg border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500 py-2 px-3 bg-white/80">
                                </div>

                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-2">📸 Image URL</label>
                                    <input type="url" name="image_url" value="{{ $page->image_url }}" placeholder="https://example.com/image.jpg" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500 py-2 px-3 bg-white/80">
                                </div>

                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-2">📝 Page Content</label>
                                    <textarea name="content" rows="6" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500 py-2 px-3 bg-white/80">{{ $page->content }}</textarea>
                                </div>

                                <div class="flex gap-3 pt-4">
                                    <button type="submit" class="flex-1 bg-purple-600 hover:bg-purple-500 text-white font-bold py-3 px-4 rounded-lg shadow-md transition-all">
                                        💾 Save Changes
                                    </button>
                                    <button type="button" onclick="document.getElementById('edit-modal-{{ $page->id }}').classList.add('hidden')" class="flex-1 bg-gray-300 hover:bg-gray-400 text-gray-700 font-bold py-3 px-4 rounded-lg transition-all">
                                        ✕ Cancel
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Image Preview Modal -->
                    @if($page->image_url)
                        <div id="img-modal-{{ $page->id }}" class="hidden fixed inset-0 z-50 bg-gray-900/90 backdrop-blur-sm flex justify-center items-center p-4">
                            <div class="max-w-4xl w-full">
                                <button onclick="document.getElementById('img-modal-{{ $page->id }}').classList.add('hidden')" class="text-white hover:text-gray-300 text-4xl font-bold mb-4">✕</button>
                                <img src="{{ $page->image_url }}" alt="Page {{ $page->page_number }}" class="w-full rounded-lg shadow-2xl">
                            </div>
                        </div>
                    @endif
                @empty
                    <div class="glass rounded-3xl p-12 text-center border border-dashed border-purple-300">
                        <p class="text-4xl mb-4">📝</p>
                        <p class="text-xl font-bold text-gray-900 mb-2">No pages yet!</p>
                        <p class="text-gray-600">Add your first story page using the form on the left →</p>
                    </div>
                @endforelse
            </div>

            <!-- Action Bar -->
            @if($pages->count() > 0)
                <div class="mt-8 p-6 bg-gradient-to-r from-purple-100 to-pink-100 rounded-3xl border-2 border-purple-300">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-lg font-bold text-gray-900">Ready to publish? 🎉</p>
                            <p class="text-sm text-gray-600">Your story has {{ $pages->count() }} {{ $pages->count() === 1 ? 'page' : 'pages' }}</p>
                        </div>
                        <form action="{{ route('admin.stories.update', $story) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="title" value="{{ $story->title }}">
                            <input type="hidden" name="slug" value="{{ $story->slug }}">
                            <input type="hidden" name="description" value="{{ $story->description }}">
                            <input type="hidden" name="cover_image" value="{{ $story->cover_image }}">
                            <input type="hidden" name="author" value="{{ $story->author }}">
                            <input type="hidden" name="category_id" value="{{ $story->category_id }}">
                            <input type="hidden" name="age_group" value="{{ $story->age_group }}">
                            <input type="hidden" name="reading_level" value="{{ $story->reading_level }}">
                            <input type="hidden" name="duration_minutes" value="{{ $story->duration_minutes }}">
                            <input type="hidden" name="is_published" value="1">
                            <button type="submit" class="px-6 py-3 bg-green-500 hover:bg-green-600 text-white font-bold rounded-lg shadow-lg transition-all transform hover:-translate-y-1">
                                ✨ Publish Story
                            </button>
                        </form>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
