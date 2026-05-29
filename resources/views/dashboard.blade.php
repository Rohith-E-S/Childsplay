@extends('layouts.app')
@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 bg-paper">
    <div class="flex justify-between items-center mb-8 border-b border-book pb-4">
        <h1 class="text-3xl font-extrabold text-stone-900 font-serif-book">Parent Dashboard</h1>
    </div>

    <!-- Manage Profiles -->
    <div class="mb-12">
        <h2 class="text-xl font-bold text-stone-850 mb-6 font-serif-book">Reader Profiles</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($children as $child)
            <a href="{{ route('children.show', $child) }}" class="bg-white rounded-lg p-6 border border-stone-200/80 shadow-sm relative overflow-hidden group flex flex-col justify-between hover:border-indigo-300 transition-colors cursor-pointer block text-left">
                <div>
                    <div class="flex items-center gap-4 mb-4">
                        <img src="{{ $child->avatar_url }}" alt="Avatar" class="w-16 h-16 rounded-full bg-stone-50 p-0.5 shadow-sm border border-stone-250/60">
                        <div>
                            <h3 class="text-lg font-bold text-stone-900 font-serif-book group-hover:text-indigo-900 transition-colors">{{ $child->name }}</h3>
                            <p class="text-stone-500 font-medium text-xs font-outfit uppercase tracking-wider">Age {{ $child->age }} | {{ $child->reading_level }}</p>
                        </div>
                    </div>
                    
                    <div class="bg-stone-55 rounded-lg p-4 mt-4 border border-stone-200/50">
                        <h4 class="font-bold text-indigo-900 mb-2 text-xs font-outfit uppercase tracking-wider">Recently Read</h4>
                        @if($child->readingHistories->count() > 0)
                            <ul class="text-xs font-semibold text-stone-600 space-y-2 font-outfit">
                            @foreach($child->readingHistories->take(2) as $history)
                                <li class="flex items-center gap-2">
                                    <span class="text-indigo-950">✓</span> 
                                    <span class="truncate block max-w-[180px]">{{ $history->story->title }}</span>
                                </li>
                            @endforeach
                            </ul>
                        @else
                            <p class="text-xs text-stone-500 italic font-outfit">No stories read yet.</p>
                        @endif
                    </div>
                </div>
            </a>
            @endforeach

            <!-- Add Child Card -->
            <button onclick="document.getElementById('add-child-modal').classList.remove('hidden')" class="bg-paper rounded-lg p-6 border border-dashed border-stone-300 flex flex-col items-center justify-center text-stone-600 hover:text-stone-950 hover:bg-stone-50 hover:border-stone-400 transition-all h-full min-h-[180px] font-outfit cursor-pointer shadow-sm">
                <div class="w-12 h-12 rounded-full bg-stone-100 flex items-center justify-center mb-3 shadow-sm border border-stone-200/50">
                    <span class="text-stone-700 font-bold text-xl">+</span>
                </div>
                <span class="font-bold text-sm">Add Child Profile</span>
            </button>
        </div>
    </div>
</div>

<!-- Add Child Modal -->
<div id="add-child-modal" class="hidden fixed inset-0 z-50 bg-stone-900/60 backdrop-blur-sm flex justify-center items-center px-4">
    <div class="bg-white rounded-lg p-8 max-w-md w-full shadow-lg relative border border-stone-200">
        <button onclick="document.getElementById('add-child-modal').classList.add('hidden')" class="absolute top-4 right-4 text-stone-400 hover:text-stone-700 text-2xl font-bold cursor-pointer">&times;</button>
        <h3 class="text-xl font-bold mb-6 text-stone-900 font-serif-book text-center">New Reader Profile</h3>
        <form method="POST" action="{{ route('children.store') }}" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-bold text-stone-550 mb-1 font-outfit uppercase tracking-wider">Child's Name</label>
                <input type="text" name="name" required class="w-full rounded-lg border-stone-300 shadow-sm focus:border-indigo-900 focus:ring-indigo-900 py-2.5 px-4 bg-stone-50/50 font-medium text-sm font-outfit">
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-stone-550 mb-1 font-outfit uppercase tracking-wider">Age</label>
                    <input type="number" name="age" min="2" max="15" required class="w-full rounded-lg border-stone-300 shadow-sm focus:border-indigo-900 focus:ring-indigo-900 py-2.5 px-4 bg-stone-50/50 font-medium text-sm font-outfit">
                </div>
                <div>
                    <label class="block text-xs font-bold text-stone-550 mb-1 font-outfit uppercase tracking-wider">Reading Level</label>
                    <select name="reading_level" required class="w-full rounded-lg border-stone-300 shadow-sm focus:border-indigo-900 focus:ring-indigo-900 py-2.5 px-4 bg-stone-50/50 font-medium text-xs font-outfit">
                        <option value="Beginner">Beginner</option>
                        <option value="Intermediate">Intermediate</option>
                        <option value="Advanced">Advanced</option>
                    </select>
                </div>
            </div>
            <button type="submit" class="w-full bg-indigo-900 hover:bg-indigo-950 text-white font-bold py-3 px-4 rounded-lg shadow-sm transition-colors mt-6 text-sm font-outfit cursor-pointer">Create Profile</button>
        </form>
    </div>
</div>
@endsection