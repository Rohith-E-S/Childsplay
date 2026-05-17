<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'StoryNest') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=poppins:400,500,600,700,800|quicksand:500,600,700" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Quicksand', sans-serif; }
        h1, h2, h3, h4, h5, h6, .font-poppins { font-family: 'Poppins', sans-serif; }
        .glass { background: rgba(255, 255, 255, 0.7); backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.3); }
        .bg-gradient-magic { background: linear-gradient(135deg, #FF9A9E 0%, #FECFEF 99%, #FECFEF 100%); }
    </style>
</head>
<body class="bg-gradient-magic min-h-screen text-gray-800 antialiased selection:bg-purple-300 selection:text-purple-900 flex flex-col">
    <nav class="glass sticky top-0 z-50 w-full shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20">
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center gap-2">
                        <span class="text-3xl font-extrabold font-poppins text-transparent bg-clip-text bg-gradient-to-r from-purple-600 to-pink-500 hover:scale-105 transition-transform">✨ StoryNest</span>
                    </a>
                </div>
                <div class="hidden sm:flex sm:items-center sm:space-x-8">
                    <a href="{{ route('stories.index') }}" class="text-lg font-bold text-gray-700 hover:text-purple-600 transition-colors">Library</a>
                    @auth
                        @if(Auth::user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}" class="text-lg font-bold text-gray-700 hover:text-purple-600 transition-colors">Admin</a>
                        @else
                            <a href="{{ route('dashboard') }}" class="text-lg font-bold text-gray-700 hover:text-purple-600 transition-colors">Dashboard</a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="bg-white/50 hover:bg-white text-purple-600 font-bold py-2 px-4 rounded-full shadow transition-all border border-purple-100">Log Out</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-lg font-bold text-gray-700 hover:text-purple-600 transition-colors">Log in</a>
                        <a href="{{ route('register') }}" class="bg-purple-600 hover:bg-purple-500 text-white font-bold py-2 px-6 rounded-full shadow-lg hover:shadow-xl transition-all transform hover:-translate-y-1">Get Started</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>
    <main class="flex-grow">
        @yield('content')
    </main>
    <footer class="glass mt-auto py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p class="text-gray-500 font-medium">© {{ date('Y') }} StoryNest. Bringing magic to reading. 🌟</p>
        </div>
    </footer>
</body>
</html>