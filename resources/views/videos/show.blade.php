@extends('layouts.app')

@section('title', $video['title'].' - Erijane')

@section('content')
<div class="site-container py-12">
    <a href="{{ route('videos') }}" class="text-sm text-muted transition hover:text-ink">← All videos</a>
    <div class="mt-6 overflow-hidden rounded-3xl bg-white p-4 shadow-sm ring-1 ring-black/5 sm:p-6">
        <div class="relative aspect-video overflow-hidden rounded-[1.25rem] bg-ink-strong">
            @if (! empty($video['youtube_id']))
                <div id="video-embed" class="absolute inset-0 hidden bg-black">
                    <iframe
                        src="https://www.youtube-nocookie.com/embed/{{ $video['youtube_id'] }}?rel=0&playsinline=1"
                        title="{{ $video['title'] }}"
                        class="h-full w-full"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        referrerpolicy="strict-origin-when-cross-origin"
                        allowfullscreen
                        loading="lazy"
                    ></iframe>
                    <button type="button" id="video-minimize" class="absolute right-3 top-3 z-10 inline-flex h-9 w-9 items-center justify-center rounded-full bg-black/60 text-white transition hover:bg-black/80" aria-label="Close video">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M6 6l12 12M18 6L6 18"/></svg>
                    </button>
                </div>
            @endif
            <img src="{{ \App\Support\Media::url($video['image'] ?? null) }}" alt="{{ \App\Support\Media::alt($video['title'] ?? null, 'Workout video') }}" class="h-full w-full object-cover opacity-80" id="video-poster">
            <button type="button" id="video-play" class="absolute inset-0 flex items-center justify-center" aria-label="Play video">
                <span class="play-btn h-16 w-16 transition duration-200 hover:scale-105">
                    <svg class="ml-1 h-6 w-6" viewBox="0 0 24 24" fill="currentColor"><path d="M8 5v14l11-7z"/></svg>
                </span>
            </button>
            <div id="video-shell" class="absolute inset-x-0 bottom-0 hidden bg-gradient-to-t from-black/80 to-transparent p-4 text-white">
                <div class="flex items-center gap-3">
                    <div class="h-1 flex-1 overflow-hidden rounded-full bg-white/30">
                        <div class="h-full w-1/5 rounded-full bg-white"></div>
                    </div>
                    <span class="text-xs tabular-nums">0:00 / {{ $video['duration'] }}</span>
                </div>
                <p class="mt-2 text-xs text-white/80">Preview shell only. No copyrighted stream is loaded.</p>
            </div>
        </div>
        <div class="pt-6">
            <p class="text-sm text-muted">{{ $video['date'] }} · {{ $video['duration'] }} · {{ $video['category'] }}</p>
            <h1 class="mt-2 font-display text-3xl font-semibold tracking-tight text-ink">{{ $video['title'] }}</h1>
            <p class="mt-4 max-w-2xl text-muted">Follow along with this workout in the Erijane app. This local clone shows the player chrome only.</p>
            <div class="mt-6 flex flex-wrap items-center gap-3">
                @if (! empty($video['external_url']))
                    <a href="{{ $video['external_url'] }}" target="_blank" rel="noopener" class="btn-pill">Watch on YouTube</a>
                @endif
                <a href="{{ route('signup') }}" class="btn-outline-pill">Save to My Journey</a>
            </div>
            @if (! empty($video['external_url']))
                <p class="mt-3 text-xs text-muted">Player asks you to sign in? Your browser blocks third-party cookies inside embeds — <a href="{{ $video['external_url'] }}" target="_blank" rel="noopener" class="underline transition hover:text-ink">open it on YouTube instead</a>.</p>
            @endif
        </div>
    </div>

    @php
        $relatedVideos = \App\Models\Video::query()
            ->published()
            ->where('id', '!=', $video['id'])
            ->when($video['category'], fn ($q) => $q->where('category', $video['category']))
            ->orderBy('sort')
            ->take(5)
            ->get();
        if ($relatedVideos->count() < 5) {
            $relatedVideos = \App\Models\Video::query()
                ->published()
                ->where('id', '!=', $video['id'])
                ->orderBy('sort')
                ->take(5)
                ->get();
        }
    @endphp
    @if ($relatedVideos->isNotEmpty())
        <section class="mt-16">
            <div class="programs-row-head">
                <h2 class="programs-h2">Related Workouts</h2>
                <a href="{{ route('videos') }}" class="programs-view-all max-lg:hidden">View All</a>
                <a href="{{ route('videos') }}" class="programs-view-all-link lg:hidden">View All</a>
            </div>
            <div class="programs-rail mt-5 lg:hidden">
                @foreach ($relatedVideos as $rel)
                    <x-videos.landscape-card :video="$rel" />
                @endforeach
            </div>
            <div class="programs-rail programs-rail--fit mt-5 max-lg:hidden">
                @foreach ($relatedVideos as $rel)
                    <x-videos.landscape-card :video="$rel" />
                @endforeach
            </div>
        </section>
    @endif
</div>
<script>
    document.getElementById('video-play')?.addEventListener('click', () => {
        const embed = document.getElementById('video-embed');
        if (embed) {
            const frame = embed.querySelector('iframe');
            if (frame && !frame.src.includes('autoplay')) {
                frame.src += '&autoplay=1';
            }
            embed.classList.remove('hidden');
            document.getElementById('video-poster')?.classList.add('hidden');
            document.getElementById('video-play')?.classList.add('hidden');
            return;
        }
        document.getElementById('video-shell')?.classList.remove('hidden');
    });
    document.getElementById('video-minimize')?.addEventListener('click', () => {
        const embed = document.getElementById('video-embed');
        const frame = embed?.querySelector('iframe');
        if (frame) {
            frame.src = frame.src.replace('&autoplay=1', '');
        }
        embed?.classList.add('hidden');
        document.getElementById('video-poster')?.classList.remove('hidden');
        document.getElementById('video-play')?.classList.remove('hidden');
    });
</script>
@endsection
