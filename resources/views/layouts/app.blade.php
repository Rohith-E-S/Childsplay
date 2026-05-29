<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'StoryNest') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=lora:400,500,600,700|outfit:400,500,600,700" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Outfit', sans-serif; }
        h1, h2, h3, h4, h5, h6, .font-serif-book { font-family: 'Lora', Georgia, serif; }
        .font-outfit { font-family: 'Outfit', sans-serif; }
        .bg-paper { background-color: #FDFBF7; }
        .border-book { border-color: #EAE6DF; }
    </style>
</head>
<body class="bg-paper min-h-screen text-stone-800 antialiased selection:bg-stone-200 selection:text-stone-900 flex flex-col">
    <nav class="bg-white sticky top-0 z-50 w-full border-b border-book shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20">
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center gap-2">
                        <span class="text-2xl font-extrabold font-serif-book text-stone-900 tracking-tight hover:text-indigo-900 transition-colors">📖 StoryNest</span>
                    </a>
                </div>
                <div class="hidden sm:flex sm:items-center sm:space-x-8">
                    <a href="{{ route('stories.index') }}" class="text-base font-semibold text-stone-600 hover:text-stone-900 transition-colors">Library</a>
                    @auth
                        @php
                            $childProfiles = Auth::user()->childProfiles ?? collect();
                            $activeChildId = session('active_child_id');
                        @endphp
                        @if(Auth::user()->role !== 'admin' && $childProfiles->count() > 0)
                            <form method="POST" action="{{ route('children.switch') }}" class="flex items-center">
                                @csrf
                                <select name="child_profile_id" onchange="this.form.submit()" class="text-base font-semibold text-stone-600 bg-transparent border-none outline-none cursor-pointer hover:text-stone-900 transition-colors focus:ring-0">
                                    <option value="" disabled {{ !$activeChildId ? 'selected' : '' }}>Select Reader...</option>
                                    @foreach($childProfiles as $profile)
                                        <option value="{{ $profile->id }}" {{ $activeChildId == $profile->id ? 'selected' : '' }}>{{ $profile->name }}</option>
                                    @endforeach
                                </select>
                            </form>
                        @endif
                        @if(Auth::user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}" class="text-base font-semibold text-stone-600 hover:text-stone-900 transition-colors">Admin</a>
                        @else
                            <a href="{{ route('dashboard') }}" class="text-base font-semibold text-stone-600 hover:text-stone-900 transition-colors">Dashboard</a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="bg-stone-100 hover:bg-stone-200 text-stone-700 font-bold py-2 px-4 rounded-lg border border-stone-200 shadow-sm transition-colors text-sm">Log Out</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-base font-semibold text-stone-600 hover:text-stone-900 transition-colors">Log in</a>
                        <a href="{{ route('register') }}" class="bg-indigo-900 hover:bg-indigo-950 text-white font-bold py-2.5 px-5 rounded-lg shadow-sm transition-colors text-sm">Get Started</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>
    <main class="flex-grow">
        @yield('content')
    </main>
    <footer class="bg-white border-t border-book py-8 mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p class="text-stone-500 font-medium text-sm">© {{ date('Y') }} StoryNest. Classic storytelling for early readers.</p>
        </div>
    </footer>
    @stack('scripts')
</body>
</html>