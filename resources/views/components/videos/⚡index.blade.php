<?php

use App\Models\Video;
use Livewire\Attributes\Url;
use Livewire\Component;

new class extends Component
{
    #[Url]
    public string $category = 'All';

    public function with(): array
    {
        $items = Video::query()->published()->orderBy('sort')->get();

        if ($this->category !== 'All') {
            $items = $items->where('category', $this->category);
        }

        $items = $items->values();

        return [
            'featured' => $items->first(),
            'videos' => $items->slice(1)->values(),
            'allCount' => $items->count(),
            'categories' => ['All', 'Abs', 'Full Body', 'Pilates', 'Cardio', 'Lower Body', 'Recovery'],
        ];
    }
};
?>

<div>
    <div class="listing-toolbar">
        <span class="filter-chip">Browse By Collection</span>
        <div class="ml-auto flex flex-wrap gap-2">
            <span class="filter-chip">Search</span>
            <span class="filter-chip">Favorites</span>
            <span class="filter-chip {{ $category !== 'All' ? 'filter-chip-active' : '' }}">Filters</span>
        </div>
    </div>

    <div class="mt-6 mb-8 flex flex-wrap gap-2">
        @foreach ($categories as $categoryOption)
            <button
                type="button"
                wire:click="$set('category', '{{ $categoryOption }}')"
                class="filter-chip {{ $categoryOption === $this->category ? 'filter-chip-active' : '' }}"
            >{{ $categoryOption }}</button>
        @endforeach
    </div>

    @if ($allCount === 0)
        <x-empty-state
            message="No videos in this category."
            hint="Pick another category or publish new workouts in the admin CMS."
        />
    @else
        <div class="mb-6 flex items-end justify-between gap-4">
            <div>
                <h2 class="listing-title">Latest Workouts</h2>
                <p class="mt-1 text-sm text-muted">New sessions to keep your routine fresh.</p>
            </div>
            <span class="btn-ghost pointer-events-none text-sm">View All</span>
        </div>

        @if ($featured)
            <div class="video-featured">
                <a href="{{ route('videos.show', $featured['slug']) }}" class="video-featured__hero group">
                    <div class="video-list-card__thumb">
                        <img
                            src="{{ \App\Support\Media::url($featured['image'] ?? null) }}"
                            alt="{{ \App\Support\Media::alt($featured['title'] ?? null, 'Workout video') }}"
                            loading="eager"
                        >
                        <span class="absolute inset-0 flex items-center justify-center">
                            <span class="play-btn" aria-hidden="true">
                                <svg class="ml-0.5 h-4 w-4" viewBox="0 0 24 24" fill="currentColor"><path d="M8 5v14l11-7z"/></svg>
                            </span>
                        </span>
                        @if (! empty($featured['duration']))
                            <span class="video-duration">{{ $featured['duration'] }}</span>
                        @endif
                    </div>
                    <div class="mt-3 flex items-baseline justify-between gap-3">
                        <h3 class="font-display text-base font-semibold text-ink group-hover:underline">{{ $featured['title'] }}</h3>
                        <span class="shrink-0 text-xs text-muted">{{ $featured['date'] }}</span>
                    </div>
                    <p class="mt-1 text-xs uppercase tracking-wide text-muted">{{ $featured['category'] }}</p>
                </a>

                <div class="video-featured__rail">
                    @foreach ($videos->take(2) as $video)
                        <a href="{{ route('videos.show', $video['slug']) }}" class="group block">
                            <div class="video-list-card__thumb">
                                <img
                                    src="{{ \App\Support\Media::url($video['image'] ?? null) }}"
                                    alt="{{ \App\Support\Media::alt($video['title'] ?? null, 'Workout video') }}"
                                    loading="lazy"
                                >
                                <span class="absolute inset-0 flex items-center justify-center">
                                    <span class="play-btn" aria-hidden="true">
                                        <svg class="ml-0.5 h-4 w-4" viewBox="0 0 24 24" fill="currentColor"><path d="M8 5v14l11-7z"/></svg>
                                    </span>
                                </span>
                                @if (! empty($video['duration']))
                                    <span class="video-duration">{{ $video['duration'] }}</span>
                                @endif
                            </div>
                            <div class="mt-2 flex items-baseline justify-between gap-3">
                                <h3 class="font-display text-sm font-semibold text-ink group-hover:underline">{{ $video['title'] }}</h3>
                                <span class="shrink-0 text-xs text-muted">{{ $video['date'] }}</span>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>

            <button type="button" class="btn-ghost mt-8 w-full cursor-default" disabled aria-disabled="true">
                Load More Latest Workouts
            </button>
        @endif

        @if ($videos->count() > 2)
            <div class="mt-12">
                <div class="mb-6 flex items-end justify-between gap-4">
                    <div>
                        <h2 class="listing-title">More Workouts</h2>
                        <p class="mt-1 text-sm text-muted">Browse the library.</p>
                    </div>
                </div>
                <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($videos->slice(2) as $video)
                        <a href="{{ route('videos.show', $video['slug']) }}" class="group block cursor-pointer">
                            <div class="video-list-card__thumb">
                                <img
                                    src="{{ \App\Support\Media::url($video['image'] ?? null) }}"
                                    alt="{{ \App\Support\Media::alt($video['title'] ?? null, 'Workout video') }}"
                                    loading="lazy"
                                >
                                <span class="absolute inset-0 flex items-center justify-center">
                                    <span class="play-btn" aria-hidden="true">
                                        <svg class="ml-0.5 h-4 w-4" viewBox="0 0 24 24" fill="currentColor"><path d="M8 5v14l11-7z"/></svg>
                                    </span>
                                </span>
                                @if (! empty($video['duration']))
                                    <span class="video-duration">{{ $video['duration'] }}</span>
                                @endif
                            </div>
                            <div class="mt-3 flex items-baseline justify-between gap-3">
                                <h3 class="font-display text-sm font-semibold text-ink group-hover:underline">{{ $video['title'] }}</h3>
                                <span class="shrink-0 text-xs text-muted">{{ $video['date'] }}</span>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    @endif
</div>
