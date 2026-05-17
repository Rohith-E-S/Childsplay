@extends('layouts.app')
@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-4xl font-extrabold text-gray-900 font-poppins">Parent Dashboard 👨‍👩‍👧‍👦</h1>
    </div>

    <!-- Manage Profiles -->
    <div class="mb-12">
        <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center gap-2">Little Readers</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($children as $child)
            <div class="glass rounded-3xl p-6 shadow-lg border border-white relative overflow-hidden group">
                <div class="absolute top-0 right-0 p-4 opacity-10 text-6xl group-hover:scale-110 transition-transform">🎓</div>
                <div class="flex items-center gap-4 mb-4">
                    <img src="{{ $child->avatar_url }}" alt="Avatar" class="w-20 h-20 rounded-full bg-white p-1 shadow-md border-2 border-purple-300">
                    <div>
                        <h3 class="text-2xl font-bold text-gray-900 font-poppins">{{ $child->name }}</h3>
                        <p class="text-gray-600 font-semibold text-sm">Age: {{ $child->age }} | Level: {{ $child->reading_level }}</p>
                    </div>
                </div>
                <div class="bg-white/50 rounded-2xl p-4 mt-4">
                    <h4 class="font-bold text-purple-700 mb-2 text-sm">Recently Read</h4>
                    @if($child->readingHistories->count() > 0)
                        <ul class="text-sm font-semibold text-gray-700 space-y-1">
                        @foreach($child->readingHistories->take(2) as $history)
                            <li class="flex items-center gap-2"><span class="text-green-500">✓</span> {{ $history->story->title }}</li>
                        @endforeach
                        </ul>
                    @else
                        <p class="text-sm text-gray-500 italic">No stories read yet. Time for an adventure!</p>
                    @endif
                </div>
            </div>
            @endforeach

            <!-- Add Child Card -->
            <button onclick="document.getElementById('add-child-modal').classList.remove('hidden')" class="glass rounded-3xl p-6 shadow-sm border border-dashed border-purple-300 flex flex-col items-center justify-center text-purple-500 hover:text-purple-700 hover:bg-white/50 transition-colors h-full min-h-[250px]">
                <div class="w-16 h-16 rounded-full bg-purple-100 flex items-center justify-center text-3xl mb-4 shadow-inner">➕</div>
                <span class="font-bold text-lg">Add Child Profile</span>
            </button>
        </div>
    </div>
</div>

<!-- Add Child Modal -->
<div id="add-child-modal" class="hidden fixed inset-0 z-50 bg-gray-900/50 backdrop-blur-sm flex justify-center items-center">
    <div class="bg-white rounded-3xl p-8 max-w-md w-full shadow-2xl relative border-4 border-purple-200">
        <button onclick="document.getElementById('add-child-modal').classList.add('hidden')" class="absolute top-4 right-4 text-gray-400 hover:text-gray-700 text-2xl">&times;</button>
        <h3 class="text-2xl font-bold mb-6 text-gray-900 font-poppins text-center">New Explorer! 🚀</h3>
        <form method="POST" action="{{ route('children.store') }}" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Child's Name</label>
                <input type="text" name="name" required class="w-full rounded-xl border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500 py-3 px-4 bg-gray-50 font-medium">
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Age</label>
                    <input type="number" name="age" min="2" max="15" required class="w-full rounded-xl border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500 py-3 px-4 bg-gray-50 font-medium">
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Reading Level</label>
                    <select name="reading_level" required class="w-full rounded-xl border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500 py-3 px-4 bg-gray-50 font-medium text-sm">
                        <option value="Beginner">Beginner</option>
                        <option value="Intermediate">Intermediate</option>
                        <option value="Advanced">Advanced</option>
                    </select>
                </div>
            </div>
            <button type="submit" class="w-full bg-purple-600 hover:bg-purple-500 text-white font-bold py-3 px-4 rounded-xl shadow-lg transition-colors mt-6 text-lg">Create Profile 🌟</button>
        </form>
    </div>
</div>
@endsection