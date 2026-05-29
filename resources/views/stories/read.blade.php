<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reading: {{ $story->title }}</title>
    <link href="https://fonts.bunny.net/css?family=lora:400,500,600,700|outfit:400,500,650,700" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Outfit', sans-serif; background-color: #FAF8F6; }
        .page-content { font-family: 'Lora', Georgia, serif; font-size: 2.25rem; line-height: 1.6; color: #1c1917; max-width: 44rem; }
        .glass-nav { background: #FFFFFF; border-b: 1px solid #EAE6DF; }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>
</head>
<body class="min-h-screen flex flex-col bg-[#FDFBF7]">
    <nav class="glass-nav fixed top-0 w-full z-50 px-6 py-4 flex justify-between items-center">
        <a href="{{ route('stories.show', $story) }}" class="flex items-center gap-2 text-stone-600 hover:text-stone-900 font-bold text-sm transition-colors">
            ← Back to Details
        </a>
        <h1 class="font-extrabold text-base text-stone-900 font-serif-book hidden sm:block">{{ $story->title }}</h1>
        <div class="flex gap-3">
            <button id="btn-narrate" class="bg-stone-100 hover:bg-stone-200 text-stone-750 px-3.5 py-1.5 rounded-lg text-xs font-bold border border-stone-200 shadow-sm transition-colors" title="Toggle Narration">🔊 Narration</button>
            <button class="bg-stone-100 hover:bg-stone-200 text-stone-750 px-3.5 py-1.5 rounded-lg text-xs font-bold border border-stone-200 shadow-sm transition-colors" title="Toggle Fullscreen" onclick="document.documentElement.requestFullscreen()">🔲 Fullscreen</button>
        </div>
    </nav>

    <main class="flex-grow flex items-center justify-center pt-24 pb-12 px-4 relative overflow-hidden" id="reading-container">
        <div class="max-w-4xl w-full bg-white rounded-xl shadow-md overflow-hidden relative z-10 border border-stone-200/80 flex flex-col min-h-[600px]">
            @if($story->pages->count() > 0)
                <div class="flex-grow flex flex-col">
                    <img id="page-image" src="{{ $story->pages->first()->image_url }}" class="w-full h-80 object-cover border-b border-stone-200/80">
                    <div class="p-8 sm:p-12 flex-grow flex items-center justify-center text-center">
                        <p id="page-content" class="page-content font-bold">{{ $story->pages->first()->content ?? 'Once upon a time...' }}</p>
                    </div>
                </div>
                <div class="bg-stone-50 p-6 flex justify-between items-center border-t border-stone-200/80 font-outfit">
                    <button id="btn-prev" class="px-6 py-2.5 bg-stone-150 text-stone-400 rounded-lg font-bold opacity-50 cursor-not-allowed text-base transition-colors border border-stone-200/50" disabled>Previous</button>
                    <span id="page-indicator" class="font-bold text-stone-500 text-base">Page 1 of {{ $story->pages->count() }}</span>
                    <button id="btn-next" class="px-6 py-2.5 bg-indigo-900 hover:bg-indigo-950 text-white rounded-lg font-bold shadow-sm transition-colors text-base">Next →</button>
                </div>

                <script>
                    document.addEventListener('DOMContentLoaded', () => {
                        const pages = @json($story->pages);
                        let currentPageIndex = 0;
                        let isNarrating = false;
                        let synth = window.speechSynthesis;
                        
                        const imgEl = document.getElementById('page-image');
                        const contentEl = document.getElementById('page-content');
                        const indicatorEl = document.getElementById('page-indicator');
                        const btnPrev = document.getElementById('btn-prev');
                        const btnNext = document.getElementById('btn-next');
                        const btnNarrate = document.getElementById('btn-narrate');
                        
                        // Create audio element for page turns
                        const pageTurnSound = new Audio('https://actions.google.com/sounds/v1/foley/book_page_turn.ogg');

                        function animatePageTransition(callback) {
                            // Fade out
                            imgEl.style.opacity = '0';
                            contentEl.style.opacity = '0';
                            contentEl.style.transform = 'translateY(10px)';
                            
                            setTimeout(() => {
                                callback();
                                // Fade in
                                imgEl.style.opacity = '1';
                                contentEl.style.opacity = '1';
                                contentEl.style.transform = 'translateY(0)';
                                
                                // Play page turn sound
                                pageTurnSound.currentTime = 0;
                                pageTurnSound.play().catch(e => console.log('Audio play failed:', e));
                            }, 300);
                        }

                        function updatePage() {
                            const page = pages[currentPageIndex];
                            
                            // Stop current narration if running
                            if (isNarrating) {
                                synth.cancel();
                                playNarration(page.content);
                            }
                            
                            // Update content
                            imgEl.src = page.image_url;
                            contentEl.textContent = page.content || 'Once upon a time...';
                            indicatorEl.textContent = `Page ${currentPageIndex + 1} of ${pages.length}`;

                            // Update Previous button state
                            if (currentPageIndex === 0) {
                                btnPrev.disabled = true;
                                btnPrev.classList.add('opacity-50', 'cursor-not-allowed');
                                btnPrev.classList.remove('hover:bg-stone-200', 'text-stone-750', 'shadow-sm', 'bg-stone-100');
                                btnPrev.classList.add('bg-stone-150', 'text-stone-400');
                            } else {
                                btnPrev.disabled = false;
                                btnPrev.classList.remove('opacity-50', 'cursor-not-allowed', 'bg-stone-150', 'text-stone-400');
                                btnPrev.classList.add('hover:bg-stone-200', 'text-stone-750', 'shadow-sm', 'bg-stone-100');
                            }

                            // Update Next button state
                            if (currentPageIndex === pages.length - 1) {
                                btnNext.textContent = 'Finish 🏆';
                                btnNext.classList.replace('bg-indigo-900', 'bg-emerald-800');
                                btnNext.classList.replace('hover:bg-indigo-950', 'hover:bg-emerald-900');
                            } else {
                                btnNext.textContent = 'Next →';
                                btnNext.classList.replace('bg-emerald-800', 'bg-indigo-900');
                                btnNext.classList.replace('hover:bg-emerald-900', 'hover:bg-indigo-950');
                            }
                        }

                        function playNarration(text) {
                            if (!text) return;
                            const utterance = new SpeechSynthesisUtterance(text);
                            utterance.rate = 0.9; // Slightly slower for kids
                            utterance.pitch = 1.1; // Slightly higher pitch
                            
                            // Try to find a friendly voice
                            const voices = synth.getVoices();
                            const friendlyVoice = voices.find(v => v.name.includes('Google') || v.name.includes('Samantha'));
                            if (friendlyVoice) utterance.voice = friendlyVoice;
                            
                            synth.speak(utterance);
                        }

                        btnPrev.addEventListener('click', () => {
                            if (currentPageIndex > 0) {
                                animatePageTransition(() => {
                                    currentPageIndex--;
                                    updatePage();
                                });
                            }
                        });

                        btnNext.addEventListener('click', () => {
                            if (currentPageIndex < pages.length - 1) {
                                animatePageTransition(() => {
                                    currentPageIndex++;
                                    updatePage();
                                });
                            } else {
                                synth.cancel();
                                
                                // Play cheering sound
                                const cheerSound = new Audio('https://actions.google.com/sounds/v1/crowds/kids_cheering.ogg');
                                cheerSound.play().catch(e => console.log('Audio play failed:', e));

                                // Confetti animation
                                var duration = 3 * 1000;
                                var end = Date.now() + duration;

                                (function frame() {
                                    confetti({
                                        particleCount: 5,
                                        angle: 60,
                                        spread: 55,
                                        origin: { x: 0 },
                                        colors: ['#a864fd', '#29cdff', '#78ff44', '#ff718d', '#fdff6a']
                                    });
                                    confetti({
                                        particleCount: 5,
                                        angle: 120,
                                        spread: 55,
                                        origin: { x: 1 },
                                        colors: ['#a864fd', '#29cdff', '#78ff44', '#ff718d', '#fdff6a']
                                    });

                                    if (Date.now() < end) {
                                        requestAnimationFrame(frame);
                                    }
                                }());

                                // Save progress via AJAX, then redirect after animation
                                fetch("{{ route('stories.progress', $story) }}", {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                    }
                                }).catch(err => console.error('Error saving progress:', err))
                                .finally(() => {
                                    setTimeout(() => {
                                        window.location.href = "{{ route('stories.show', $story) }}";
                                    }, 3500);
                                });
                            }
                        });
                        
                        btnNarrate.addEventListener('click', () => {
                            if (isNarrating) {
                                synth.cancel();
                                isNarrating = false;
                                btnNarrate.classList.replace('bg-indigo-900', 'bg-stone-100');
                                btnNarrate.classList.replace('text-white', 'text-stone-750');
                            } else {
                                isNarrating = true;
                                btnNarrate.classList.replace('bg-stone-100', 'bg-indigo-900');
                                btnNarrate.classList.replace('text-stone-750', 'text-white');
                                playNarration(pages[currentPageIndex].content);
                            }
                        });

                        // Set initial transition styles
                        imgEl.style.transition = 'opacity 0.3s ease-in-out';
                        contentEl.style.transition = 'opacity 0.3s ease-in-out, transform 0.3s ease-in-out';
                    });
                </script>
            @else
                <div class="p-12 text-center text-xl font-bold text-stone-500 flex-grow flex items-center justify-center">
                    Story pages coming soon! ✨
                </div>
            @endif
        </div>
    </main>
</body>
</html>