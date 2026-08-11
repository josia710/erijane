@extends('layouts.app')

@section('title', $video['title'].' - Erijane')

@section('content')
<div class="site-container py-12">
    <a href="{{ route('videos') }}" class="text-sm text-muted transition hover:text-ink">← All videos</a>
    <div class="mt-6 overflow-hidden rounded-3xl bg-white p-4 shadow-sm ring-1 ring-black/5 sm:p-6">
        <div class="relative aspect-video overflow-hidden rounded-[1.25rem] bg-ink-strong">
            <img src="{{ \App\Support\Media::url($video['image'] ?? null) }}" alt="{{ \App\Support\Media::alt($video['title'] ?? null, 'Workout video') }}" class="h-full w-full object-cover opacity-80">
            <button type="button" id="video-play" class="absolute inset-0 flex items-center justify-center" aria-label="Play preview">
                <span class="play-btn h-16 w-16">
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
        </div>
    </div>
</div>
<script>
    document.getElementById('video-play')?.addEventListener('click', () => {
        document.getElementById('video-shell')?.classList.remove('hidden');
    });
</script>
@endsection
