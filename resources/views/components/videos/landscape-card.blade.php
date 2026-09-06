@props([
    'video',
    'featured' => false,
])

@php
    $clock = \App\Support\VideoListing::clockLabel($video);
    $tags = $featured ? \App\Support\VideoListing::tags($video) : [];
@endphp

<a href="{{ route('videos.show', $video['slug']) }}" class="{{ $featured ? 'videos-featured group' : 'videos-card group' }}">
    <div class="{{ $featured ? 'videos-featured__thumb' : 'videos-card__thumb' }}">
        <img
            src="{{ \App\Support\Media::url($video['image'] ?? null) }}"
            alt="{{ \App\Support\Media::alt($video['title'] ?? null, 'Workout video') }}"
            loading="{{ $featured ? 'eager' : 'lazy' }}"
        >
        <span class="video-duration">{{ $clock }}</span>
    </div>
    <div class="{{ $featured ? 'videos-featured__body' : 'videos-card__body' }}">
        <h3 class="{{ $featured ? 'videos-featured__title' : 'videos-card__title' }} font-medium">{{ $video['title'] }}</h3>
        @if ($tags !== [])
            <div class="videos-tags">
                @foreach ($tags as $tag)
                    <span class="videos-tag">{{ $tag }}</span>
                @endforeach
            </div>
        @endif
        <p class="videos-card__meta">
            <span>{{ $video['date'] }}</span>
            <span class="videos-card__icons" aria-hidden="true">
                <svg class="ui-icon ui-icon--meta-info" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><circle cx="12" cy="12" r="9"/><path d="M12 11v5M12 8h.01"/></svg>
                <svg class="ui-icon ui-icon--meta-heart" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M12 21s-7-4.4-7-10a4 4 0 017-2.6A4 4 0 0119 11c0 5.6-7 10-7 10z"/></svg>
            </span>
        </p>
    </div>
</a>
