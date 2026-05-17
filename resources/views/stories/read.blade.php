<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reading: {{ $story->title }}</title>
    <link href="https://fonts.bunny.net/css?family=comic-neue:400,700|quicksand:500,700" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Comic Neue', cursive; background-color: #fdfbf7; }
        .page-content { font-size: 2rem; line-height: 1.6; color: #2d3748; }
        .glass-nav { background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(10px); }
    </style>
</head>
<body class="min-h-screen flex flex-col">
    <nav class="glass-nav fixed top-0 w-full z-50 px-6 py-4 flex justify-between items-center border-b border-gray-200">
        <a href="{{ route('stories.show', $story) }}" class="flex items-center gap-2 text-gray-600 hover:text-purple-600 font-bold font-sans text-lg transition-colors">
            ⬅️ Back
        </a>
        <h1 class="font-bold text-xl text-gray-800 font-sans hidden sm:block">{{ $story->title }}</h1>
        <div class="flex gap-4">
            <button class="bg-purple-100 text-purple-700 p-3 rounded-full hover:bg-purple-200 transition-colors shadow-sm" title="Play Audio">🔊</button>
            <button class="bg-yellow-100 text-yellow-700 p-3 rounded-full hover:bg-yellow-200 transition-colors shadow-sm" title="Toggle Fullscreen" onclick="document.documentElement.requestFullscreen()">🔲</button>
        </div>
    </nav>

    <main class="flex-grow flex items-center justify-center pt-24 pb-12 px-4 relative overflow-hidden" id="reading-container">
        <!-- Decoration -->
        <div class="absolute -top-20 -left-20 w-64 h-64 bg-pink-200 rounded-full mix-blend-multiply filter blur-3xl opacity-50 animate-blob"></div>
        <div class="absolute top-40 -right-20 w-72 h-72 bg-purple-200 rounded-full mix-blend-multiply filter blur-3xl opacity-50 animate-blob animation-delay-2000"></div>

        <div class="max-w-4xl w-full bg-white rounded-[3rem] shadow-2xl overflow-hidden relative z-10 border-4 border-gray-50 flex flex-col min-h-[600px]">
            @if($story->pages->count() > 0)
                <div class="flex-grow flex flex-col">
                    <img id="page-image" src="{{ $story->pages->first()->image_url }}" class="w-full h-80 object-cover border-b-4 border-dashed border-gray-100">
                    <div class="p-8 sm:p-12 flex-grow flex items-center justify-center text-center">
                        <p id="page-content" class="page-content font-bold">{{ $story->pages->first()->content ?? 'Once upon a time...' }}</p>
                    </div>
                </div>
                <div class="bg-gray-50 p-6 flex justify-between items-center border-t border-gray-100">
                    <button id="btn-prev" class="px-8 py-3 bg-gray-200 text-gray-500 rounded-full font-bold font-sans opacity-50 cursor-not-allowed text-lg transition-all" disabled>Previous</button>
                    <span id="page-indicator" class="font-sans font-bold text-gray-500 text-lg">Page 1 of {{ $story->pages->count() }}</span>
                    <button id="btn-next" class="px-8 py-3 bg-purple-500 hover:bg-purple-400 text-white rounded-full font-bold font-sans shadow-md transform hover:scale-105 transition-all text-lg">Next ➡️</button>
                </div>

                <script>
                    document.addEventListener('DOMContentLoaded', () => {
                        const pages = @json($story->pages);
                        let currentPageIndex = 0;
                        
                        const imgEl = document.getElementById('page-image');
                        const contentEl = document.getElementById('page-content');
                        const indicatorEl = document.getElementById('page-indicator');
                        const btnPrev = document.getElementById('btn-prev');
                        const btnNext = document.getElementById('btn-next');

                        function updatePage() {
                            const page = pages[currentPageIndex];
                            
                            // Update content
                            imgEl.src = page.image_url;
                            contentEl.textContent = page.content || 'Once upon a time...';
                            indicatorEl.textContent = `Page ${currentPageIndex + 1} of ${pages.length}`;

                            // Update Previous button state
                            if (currentPageIndex === 0) {
                                btnPrev.disabled = true;
                                btnPrev.classList.add('opacity-50', 'cursor-not-allowed');
                                btnPrev.classList.remove('hover:bg-gray-300', 'transform', 'hover:scale-105', 'shadow-md');
                            } else {
                                btnPrev.disabled = false;
                                btnPrev.classList.remove('opacity-50', 'cursor-not-allowed');
                                btnPrev.classList.add('hover:bg-gray-300', 'transform', 'hover:scale-105', 'shadow-md');
                            }

                            // Update Next button state
                            if (currentPageIndex === pages.length - 1) {
                                btnNext.textContent = 'Finish 🏆';
                                btnNext.classList.replace('bg-purple-500', 'bg-green-500');
                                btnNext.classList.replace('hover:bg-purple-400', 'hover:bg-green-400');
                            } else {
                                btnNext.textContent = 'Next ➡️';
                                btnNext.classList.replace('bg-green-500', 'bg-purple-500');
                                btnNext.classList.replace('hover:bg-green-400', 'hover:bg-purple-400');
                            }
                        }

                        btnPrev.addEventListener('click', () => {
                            if (currentPageIndex > 0) {
                                currentPageIndex--;
                                updatePage();
                            }
                        });

                        btnNext.addEventListener('click', () => {
                            if (currentPageIndex < pages.length - 1) {
                                currentPageIndex++;
                                updatePage();
                            } else {
                                // Redirect or show completion
                                alert('Yay! You finished the story! 🎉');
                                window.location.href = "{{ route('stories.show', $story) }}";
                            }
                        });
                    });
                </script>
            @else
                <div class="p-12 text-center text-2xl font-bold text-gray-500 flex-grow flex items-center justify-center">
                    Story pages coming soon! ✨
                </div>
            @endif
        </div>
    </main>
</body>
</html>