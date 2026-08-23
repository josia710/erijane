<?php

use App\Models\Video;
use App\Support\VideoListing;
use Livewire\Attributes\Url;
use Livewire\Component;

new class extends Component
{
    #[Url]
    public string $q = '';

    #[Url]
    public string $collection = 'all';

    public bool $filtersOpen = false;

    public array $draftFocus = [];

    public array $draftType = [];

    public array $draftPreference = [];

    public array $draftDuration = [];

    public array $draftEquipment = [];

    #[Url]
    public array $focus = [];

    #[Url]
    public array $type = [];

    #[Url]
    public array $preference = [];

    #[Url]
    public array $duration = [];

    #[Url]
    public array $equipment = [];

    public function toggleFilters(): void
    {
        $this->filtersOpen = ! $this->filtersOpen;
        if ($this->filtersOpen) {
            $this->draftFocus = $this->focus;
            $this->draftType = $this->type;
            $this->draftPreference = $this->preference;
            $this->draftDuration = $this->duration;
            $this->draftEquipment = $this->equipment;
        }
    }

    public function applyFilters(): void
    {
        $this->focus = $this->draftFocus;
        $this->type = $this->draftType;
        $this->preference = $this->draftPreference;
        $this->duration = $this->draftDuration;
        $this->equipment = $this->draftEquipment;
        $this->filtersOpen = false;
    }

    public function cancelFilters(): void
    {
        $this->draftFocus = $this->focus;
        $this->draftType = $this->type;
        $this->draftPreference = $this->preference;
        $this->draftDuration = $this->duration;
        $this->draftEquipment = $this->equipment;
        $this->filtersOpen = false;
    }

    public function clearFilters(): void
    {
        $this->draftFocus = [];
        $this->draftType = [];
        $this->draftPreference = [];
        $this->draftDuration = [];
        $this->draftEquipment = [];
        $this->focus = [];
        $this->type = [];
        $this->preference = [];
        $this->duration = [];
        $this->equipment = [];
    }

    public function selectCollection(string $key): void
    {
        $this->collection = $key === '' ? 'all' : $key;
    }

    public function hasActiveFilters(): bool
    {
        return $this->focus !== []
            || $this->type !== []
            || $this->preference !== []
            || $this->duration !== []
            || $this->equipment !== [];
    }

    public function hasDraftFilters(): bool
    {
        return $this->draftFocus !== []
            || $this->draftType !== []
            || $this->draftPreference !== []
            || $this->draftDuration !== []
            || $this->draftEquipment !== [];
    }

    public function with(): array
    {
        $items = Video::query()->published()->orderBy('sort')->get();

        if ($this->q !== '') {
            $needle = mb_strtolower($this->q);
            $items = $items->filter(fn (Video $v) => str_contains(mb_strtolower((string) $v->title), $needle));
        }

        $items = $items->filter(fn (Video $v) => VideoListing::matchesFilters(
            $v,
            $this->focus,
            $this->type,
            $this->preference,
            $this->duration,
            $this->equipment,
        ))->values();

        $catalog = VideoListing::collections();
        $keys = $this->collection === 'all' || $this->collection === ''
            ? array_keys(array_filter($catalog, fn ($row) => $row['index']))
            : [$this->collection];

        $rows = [];
        foreach ($keys as $key) {
            $meta = $catalog[$key] ?? null;
            if ($meta === null) {
                continue;
            }
            $rowItems = VideoListing::forCollection($items, $key);
            if ($rowItems->isEmpty()) {
                continue;
            }
            $rows[] = [
                'key' => $key,
                'title' => $meta['title'],
                'blurb' => $meta['blurb'],
                'items' => $rowItems,
            ];
        }

        $topLatest = collect($rows)->firstWhere('key', 'latest');
        $showLatest = ($this->collection === 'all' || $this->collection === 'latest') && $topLatest;

        return [
            'allCount' => $items->count(),
            'browseOptions' => VideoListing::browseOptions(),
            'showLatest' => $showLatest,
            'topLatest' => $topLatest,
            'restRows' => $showLatest
                ? array_values(array_filter($rows, fn ($row) => $row['key'] !== 'latest'))
                : $rows,
            'focusOptions' => ['Abs', 'Arms', 'Back', 'Booty', 'Chest', 'Full Body', 'Legs', 'Lower Body', 'Upper Body'],
            'typeOptions' => ['Body Weight Workouts', 'Cooldown', 'HIIT & Cardio', 'Weighted Workouts', 'Warm Up'],
            'preferenceOptions' => ['Low Impact Alternatives', 'No Burpees', 'No Jumping', 'No Planks', 'Reps-Based', 'Standing Workout', 'Wrist Friendly'],
            'durationOptions' => ['5-10 Min', '10-15 Min', '15-20 Min', '20 Min +'],
            'equipmentOptions' => ['Bench', 'Dumbbells', 'Resistance Bands'],
        ];
    }
};
?>

<div class="videos-listing">
    <div class="site-container">
        <div class="programs-toolbar">
            <div class="relative" x-data="{ open: false }" @keydown.escape.window="open = false">
                <button
                    type="button"
                    class="programs-browse {{ $collection !== 'all' ? 'is-open' : '' }}"
                    @click="open = !open"
                    :class="open && 'is-open'"
                    :aria-expanded="open"
                    aria-haspopup="listbox"
                >
                    Browse By Collection
                    <svg class="ui-icon ui-icon--chevron" viewBox="0 0 12 8" fill="none" aria-hidden="true"><path d="M1 1.5L6 6.5L11 1.5" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/></svg>
                </button>
                <ul
                    x-cloak
                    x-show="open"
                    @click.outside="open = false"
                    class="programs-browse-menu"
                    role="listbox"
                >
                    @foreach ($browseOptions as $key => $label)
                        <li>
                            <button
                                type="button"
                                wire:click="selectCollection('{{ $key }}')"
                                @click="open = false"
                                class="programs-browse-item {{ $collection === $key ? 'is-active' : '' }}"
                            >{{ $label }}</button>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="ml-auto flex items-center gap-3">
                <label class="programs-search">
                    <svg class="ui-icon ui-icon--search text-ink" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><circle cx="11" cy="11" r="7"/><path d="M20 20l-3-3"/></svg>
                    <span class="sr-only">Search videos</span>
                    <input
                        type="search"
                        wire:model.live.debounce.300ms="q"
                        placeholder="Search"
                        class="programs-search__input"
                    >
                </label>
                <span class="videos-fav" title="Sign in to save favorites">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M12 21s-7-4.4-7-10a4 4 0 017-2.6A4 4 0 0119 11c0 5.6-7 10-7 10z"/></svg>
                    <span class="videos-fav__label">Favorites</span>
                </span>
                <button
                    type="button"
                    class="programs-filters-btn {{ $filtersOpen || $this->hasActiveFilters() ? 'is-open' : '' }}"
                    wire:click="toggleFilters"
                    aria-expanded="{{ $filtersOpen ? 'true' : 'false' }}"
                >
                    <svg class="ui-icon ui-icon--filters" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M4 7h16M7 12h10M10 17h4"/></svg>
                    <span class="programs-filters-btn__label">Filters</span>
                </button>
            </div>
        </div>

        @if ($filtersOpen)
            <div class="programs-filters hidden lg:flex" id="video-filters">
                <div class="videos-filters__cols">
                    <div>
                        <h3 class="programs-filters__label">Focus Area</h3>
                        @foreach ($focusOptions as $option)
                            <label class="programs-filters__option">
                                <input type="checkbox" wire:model="draftFocus" value="{{ $option }}">
                                {{ $option }}
                            </label>
                        @endforeach
                    </div>
                    <div>
                        <h3 class="programs-filters__label">Workout Type</h3>
                        @foreach ($typeOptions as $option)
                            <label class="programs-filters__option">
                                <input type="checkbox" wire:model="draftType" value="{{ $option }}">
                                {{ $option }}
                            </label>
                        @endforeach
                    </div>
                    <div>
                        <h3 class="programs-filters__label">Preference</h3>
                        @foreach ($preferenceOptions as $option)
                            <label class="programs-filters__option">
                                <input type="checkbox" wire:model="draftPreference" value="{{ $option }}">
                                {{ $option }}
                            </label>
                        @endforeach
                    </div>
                    <div>
                        <h3 class="programs-filters__label">Duration</h3>
                        @foreach ($durationOptions as $option)
                            <label class="programs-filters__option">
                                <input type="checkbox" wire:model="draftDuration" value="{{ $option }}">
                                {{ $option }}
                            </label>
                        @endforeach
                    </div>
                    <div>
                        <h3 class="programs-filters__label">Equipment</h3>
                        @foreach ($equipmentOptions as $option)
                            <label class="programs-filters__option">
                                <input type="checkbox" wire:model="draftEquipment" value="{{ $option }}">
                                {{ $option }}
                            </label>
                        @endforeach
                    </div>
                    <div>
                        <h3 class="programs-filters__label">History</h3>
                        <p class="programs-filters__muted">I've Tried</p>
                        <p class="programs-filters__muted">I Have Not Tried</p>
                    </div>
                </div>
                <div class="programs-filters__footer">
                    <button type="button" class="programs-filters__text {{ $this->hasActiveFilters() || $this->hasDraftFilters() ? '' : 'is-disabled' }}" wire:click="clearFilters" @disabled(! $this->hasActiveFilters() && ! $this->hasDraftFilters())>Clear Filters</button>
                    <div class="ml-auto flex items-center gap-4">
                        <button type="button" class="programs-filters__text" wire:click="cancelFilters">Cancel</button>
                        <button type="button" class="programs-filters__apply {{ $this->hasDraftFilters() ? '' : 'is-disabled' }}" wire:click="applyFilters" @disabled(! $this->hasDraftFilters())>Apply</button>
                    </div>
                </div>
            </div>

            <div class="videos-filters-sheet lg:hidden" role="dialog" aria-label="Filters" x-data="{ open: '' }">
                <div class="videos-filters-sheet__head">
                    <h3 class="font-medium text-ink">Filters</h3>
                    <button type="button" class="text-2xl leading-none text-ink" wire:click="toggleFilters" aria-label="Close filters">&times;</button>
                </div>
                @foreach ([
                    'Focus Area' => 'focusOptions',
                    'Workout Type' => 'typeOptions',
                    'Preference' => 'preferenceOptions',
                    'Duration' => 'durationOptions',
                    'Equipment' => 'equipmentOptions',
                    'History' => null,
                ] as $label => $optionKey)
                    <div class="videos-filters-sheet__row">
                        <button type="button" class="videos-filters-sheet__toggle" @click="open = open === '{{ $label }}' ? '' : '{{ $label }}'">
                            {{ $label }}
                            <svg class="ui-icon ui-icon--chevron" viewBox="0 0 12 8" fill="none" aria-hidden="true"><path d="M1 1.5L6 6.5L11 1.5" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/></svg>
                        </button>
                        <div x-cloak x-show="open === '{{ $label }}'" class="videos-filters-sheet__body">
                            @if ($optionKey === null)
                                <p class="programs-filters__muted">I've Tried</p>
                                <p class="programs-filters__muted">I Have Not Tried</p>
                            @else
                                @foreach (${$optionKey} as $option)
                                    @php
                                        $model = match ($optionKey) {
                                            'focusOptions' => 'draftFocus',
                                            'typeOptions' => 'draftType',
                                            'preferenceOptions' => 'draftPreference',
                                            'durationOptions' => 'draftDuration',
                                            default => 'draftEquipment',
                                        };
                                    @endphp
                                    <label class="programs-filters__option">
                                        <input type="checkbox" wire:model="{{ $model }}" value="{{ $option }}">
                                        {{ $option }}
                                    </label>
                                @endforeach
                            @endif
                        </div>
                    </div>
                @endforeach
                <div class="videos-filters-sheet__foot">
                    <button type="button" class="programs-filters__text {{ $this->hasActiveFilters() || $this->hasDraftFilters() ? '' : 'is-disabled' }}" wire:click="clearFilters">Clear Filters</button>
                    <button type="button" class="programs-filters__apply {{ $this->hasDraftFilters() ? '' : 'is-disabled' }}" wire:click="applyFilters" @disabled(! $this->hasDraftFilters())>Apply</button>
                </div>
            </div>
        @else
            <div class="sr-only">
                <p>Focus Area Workout Type Preference Duration Equipment History</p>
            </div>
        @endif
    </div>

    <div class="site-container pb-16 pt-8">
        @if ($allCount === 0)
            <x-empty-state
                message="No videos match these filters."
                hint="Try another collection or filter, or check back after new workouts are published."
            />
        @else
            @if ($showLatest && $topLatest)
                @php
                    $featured = $topLatest['items']->first();
                    $side = $topLatest['items']->slice(1, 2)->values();
                @endphp
                <section>
                    <div class="programs-row-head">
                        <h2 class="programs-h2">{{ $topLatest['title'] }}</h2>
                        <a href="{{ route('videos', ['collection' => 'latest']) }}" class="programs-view-all max-lg:hidden">View All</a>
                        <a href="{{ route('videos', ['collection' => 'latest']) }}" class="programs-view-all-link lg:hidden">View All</a>
                    </div>
                    <div class="videos-latest">
                        @if ($featured)
                            <x-videos.landscape-card :video="$featured" :featured="true" />
                        @endif
                        @foreach ($side as $video)
                            <div class="max-lg:hidden">
                                <x-videos.landscape-card :video="$video" />
                            </div>
                        @endforeach
                    </div>
                    <p class="videos-load-more" aria-disabled="true">Load More Latest Workouts</p>
                </section>
            @endif

            @foreach ($restRows as $row)
                <section class="programs-collection" id="collection-{{ $row['key'] }}">
                    <div class="programs-row-head {{ $row['blurb'] ? 'programs-row-head--blurb' : '' }}">
                        <div class="min-w-0">
                            <h2 class="programs-h2">{{ $row['title'] }}</h2>
                            @if ($row['blurb'])
                                <p class="programs-blurb">{{ $row['blurb'] }}</p>
                            @endif
                        </div>
                        <a href="{{ route('videos', ['collection' => $row['key']]) }}" class="programs-view-all max-lg:hidden">View All</a>
                        <a href="{{ route('videos', ['collection' => $row['key']]) }}" class="programs-view-all-link lg:hidden">View All</a>
                    </div>
                    <div class="programs-rail programs-rail--fit">
                        @foreach ($row['items']->take(5) as $video)
                            <x-videos.landscape-card :video="$video" />
                        @endforeach
                    </div>
                </section>
            @endforeach
        @endif
    </div>
</div>
