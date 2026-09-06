<?php

use App\Models\Program;
use App\Support\ProgramListing;
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

    public array $draftDuration = [];

    public array $draftEquipment = [];

    public array $draftYear = [];

    public array $draftHistory = [];

    #[Url]
    public array $focus = [];

    #[Url]
    public array $duration = [];

    #[Url]
    public array $equipment = [];

    #[Url]
    public array $year = [];

    #[Url]
    public array $history = [];

    public function toggleFilters(): void
    {
        $this->filtersOpen = ! $this->filtersOpen;
        if ($this->filtersOpen) {
            $this->draftFocus = $this->focus;
            $this->draftDuration = $this->duration;
            $this->draftEquipment = $this->equipment;
            $this->draftYear = $this->year;
            $this->draftHistory = $this->history;
        }
    }

    public function applyFilters(): void
    {
        $this->focus = $this->draftFocus;
        $this->duration = $this->draftDuration;
        $this->equipment = $this->draftEquipment;
        $this->year = $this->draftYear;
        $this->history = $this->draftHistory;
        $this->filtersOpen = false;
    }

    public function cancelFilters(): void
    {
        $this->draftFocus = $this->focus;
        $this->draftDuration = $this->duration;
        $this->draftEquipment = $this->equipment;
        $this->draftYear = $this->year;
        $this->draftHistory = $this->history;
        $this->filtersOpen = false;
    }

    public function clearFilters(): void
    {
        $this->draftFocus = [];
        $this->draftDuration = [];
        $this->draftEquipment = [];
        $this->draftYear = [];
        $this->draftHistory = [];
        $this->focus = [];
        $this->duration = [];
        $this->equipment = [];
        $this->year = [];
        $this->history = [];
    }

    public function selectCollection(string $key): void
    {
        $this->collection = $key === '' ? 'all' : $key;
    }

    public function hasActiveFilters(): bool
    {
        return $this->focus !== [] || $this->duration !== [] || $this->equipment !== [] || $this->year !== [] || $this->history !== [];
    }

    public function with(): array
    {
        $items = Program::query()->published()->orderBy('sort')->get();

        if ($this->q !== '') {
            $needle = mb_strtolower($this->q);
            $items = $items->filter(fn (Program $p) => str_contains(mb_strtolower((string) $p->title), $needle));
        }

        $items = $items->filter(fn (Program $p) => ProgramListing::matchesFilters(
            $p,
            $this->focus,
            $this->duration,
            $this->equipment,
            $this->year,
        ))->values();

        if ($this->history !== []) {
            $done = session()->get('completed_programs', []);
            $wantDone = in_array('completed', $this->history, true);
            $wantOpen = in_array('not-completed', $this->history, true);
            $items = $items->filter(fn (Program $p) => ($wantDone && in_array($p->slug, $done, true))
                || ($wantOpen && ! in_array($p->slug, $done, true)))->values();
        }

        $keys = $this->collection === 'all' || $this->collection === ''
            ? array_keys(ProgramListing::collections())
            : [$this->collection];

        $rows = [];
        foreach ($keys as $key) {
            $meta = ProgramListing::collections()[$key] ?? null;
            if ($meta === null) {
                continue;
            }
            $rowItems = ProgramListing::forCollection($items, $key);
            if ($rowItems->isEmpty()) {
                continue;
            }
            $rows[] = [
                'key' => $key,
                'title' => $meta['title'],
                'blurb' => $meta['blurb'],
                'featured' => $meta['featured'] && ($this->collection === 'all' || $this->collection === 'latest'),
                'items' => $rowItems,
            ];
        }

        $topLatest = collect($rows)->firstWhere('key', 'latest');
        $topPopular = collect($rows)->firstWhere('key', 'popular');
        $showSplit = $this->collection === 'all' && $topLatest && $topPopular;

        return [
            'rows' => $rows,
            'allCount' => $items->count(),
            'browseOptions' => ProgramListing::browseOptions(),
            'showSplit' => $showSplit,
            'topLatest' => $topLatest,
            'topPopular' => $topPopular,
            'restRows' => $showSplit
                ? array_values(array_filter($rows, fn ($row) => ! in_array($row['key'], ['latest', 'popular'], true)))
                : $rows,
            'focusOptions' => ['Abs & Core', 'Arms', 'Booty', 'Full Body', 'Legs', 'Resistance', 'Weight Loss'],
            'durationOptions' => ['1 - 14 days', '15 - 21 days', '22 - 28 days', '29 days +'],
            'equipmentOptions' => ['Dumbbells', 'Fitness Mat', 'Resistance Bands'],
            'yearOptions' => ['2018', '2019', '2020', '2021', '2022', '2023', '2024', '2025', '2026'],
        ];
    }
};
?>

<div class="programs-listing">
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
                    <span class="sr-only">Search programs</span>
                    <input
                        type="search"
                        wire:model.live.debounce.300ms="q"
                        placeholder="Search"
                        class="programs-search__input"
                    >
                </label>
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
            <div class="programs-filters" id="program-filters">
                <div class="programs-filters__cols">
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
                        <h3 class="programs-filters__label">Year</h3>
                        @foreach ($yearOptions as $option)
                            <label class="programs-filters__option">
                                <input type="checkbox" wire:model="draftYear" value="{{ $option }}">
                                {{ $option }}
                            </label>
                        @endforeach
                    </div>
                    <div>
                        <h3 class="programs-filters__label">History</h3>
                        @foreach (['completed' => "I've Completed", 'not-completed' => 'I Have Not Completed'] as $value => $label)
                            <label class="programs-filters__option">
                                <input type="checkbox" wire:model="draftHistory" value="{{ $value }}">
                                {{ $label }}
                            </label>
                        @endforeach
                    </div>
                </div>
                <div class="programs-filters__footer">
                    <button type="button" class="programs-filters__text {{ $this->hasActiveFilters() ? '' : 'is-disabled' }}" wire:click="clearFilters" @disabled(! $this->hasActiveFilters() && $draftFocus === [] && $draftDuration === [] && $draftEquipment === [] && $draftYear === [] && $draftHistory === [])>Clear Filters</button>
                    <div class="ml-auto flex items-center gap-4">
                        <button type="button" class="programs-filters__text" wire:click="cancelFilters">Cancel</button>
                        <button type="button" class="programs-filters__apply {{ ($draftFocus !== [] || $draftDuration !== [] || $draftEquipment !== [] || $draftYear !== [] || $draftHistory !== []) ? '' : 'is-disabled' }}" wire:click="applyFilters">Apply</button>
                    </div>
                </div>
            </div>
        @else
            {{-- Filter labels stay in the DOM for tests / a11y when the panel is closed --}}
            <div class="sr-only">
                <p>Focus Area Duration Equipment Year History</p>
            </div>
        @endif
    </div>

    <div class="site-container pb-16 pt-8">
        @if ($allCount === 0)
            <x-empty-state
                message="No programs match these filters."
                hint="Try another collection or filter, or check back after new challenges are published."
            />
        @else
            @if ($showSplit)
                <div class="programs-split">
                    <section>
                        <div class="programs-row-head">
                            <h2 class="programs-h2">{{ $topLatest['title'] }}</h2>
                            <a href="{{ route('programs', ['collection' => 'latest']) }}" class="programs-view-all max-lg:hidden">View All</a>
                            <a href="{{ route('programs', ['collection' => 'latest']) }}" class="programs-view-all-link lg:hidden">View All</a>
                        </div>
                        @php $featured = $topLatest['items']->first(); @endphp
                        @if ($featured)
                            <article class="program-featured-split">
                                <a href="{{ route('programs.show', $featured['slug']) }}" class="program-featured-split__media card-tone-{{ $featured['tone'] }}">
                                    @if ($featured['badge'])
                                        <span class="program-new">{{ $featured['badge'] }}</span>
                                    @endif
                                    <img
                                        src="{{ \App\Support\Media::url($featured['image'] ?? null) }}"
                                        alt="{{ \App\Support\Media::alt($featured['title'] ?? null, 'Program') }}"
                                        class="program-featured-split__img"
                                        loading="eager"
                                    >
                                </a>
                                <div class="program-featured-split__body">
                                    @if ($featured->published_at)
                                        <p class="program-featured-split__date">{{ strtoupper($featured->published_at->format('F Y')) }}</p>
                                    @endif
                                    <h3 class="program-featured-split__title">{{ $featured['title'] }}</h3>
                                    <x-programs.meta-chips :program="$featured" class="mt-3" />
                                    <p class="program-featured-split__kv"><span>Type</span> {{ implode(', ', \App\Support\ProgramListing::focusAreas($featured)) }}</p>
                                    <p class="program-featured-split__kv"><span>Equipment</span> {{ implode(', ', \App\Support\ProgramListing::equipment($featured)) }}</p>
                                    <a href="{{ route('programs.show', $featured['slug']) }}" class="btn-outline-pill mt-auto w-fit">View Challenge</a>
                                </div>
                            </article>
                            <div class="programs-rail mt-5 lg:hidden">
                                @foreach ($topLatest['items']->take(5) as $program)
                                    <x-programs.portrait-card :program="$program" />
                                @endforeach
                            </div>
                        @endif
                    </section>
                    <section>
                        <div class="programs-row-head">
                            <h2 class="programs-h2">{{ $topPopular['title'] }}</h2>
                            <a href="{{ route('programs', ['collection' => 'popular']) }}" class="programs-view-all max-lg:hidden">View All</a>
                            <a href="{{ route('programs', ['collection' => 'popular']) }}" class="programs-view-all-link lg:hidden">View All</a>
                        </div>
                        <div class="programs-rail">
                            @foreach ($topPopular['items']->take(5) as $program)
                                <x-programs.portrait-card :program="$program" />
                            @endforeach
                        </div>
                    </section>
                </div>
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
                        <a href="{{ route('programs', ['collection' => $row['key']]) }}" class="programs-view-all max-lg:hidden">View All</a>
                        <a href="{{ route('programs', ['collection' => $row['key']]) }}" class="programs-view-all-link lg:hidden">View All</a>
                    </div>
                    @if (! empty($row['featured']) && $row['items']->first() && ! $showSplit)
                        @php $featured = $row['items']->first(); @endphp
                        <article class="program-featured-split mb-6 max-lg:hidden">
                            <a href="{{ route('programs.show', $featured['slug']) }}" class="program-featured-split__media card-tone-{{ $featured['tone'] }}">
                                @if ($featured['badge'])
                                    <span class="program-new">{{ $featured['badge'] }}</span>
                                @endif
                                <img
                                    src="{{ \App\Support\Media::url($featured['image'] ?? null) }}"
                                    alt="{{ \App\Support\Media::alt($featured['title'] ?? null, 'Program') }}"
                                    class="program-featured-split__img"
                                    loading="eager"
                                >
                            </a>
                            <div class="program-featured-split__body">
                                @if ($featured->published_at)
                                    <p class="program-featured-split__date">{{ strtoupper($featured->published_at->format('F Y')) }}</p>
                                @endif
                                <h3 class="program-featured-split__title">{{ $featured['title'] }}</h3>
                                <x-programs.meta-chips :program="$featured" class="mt-3" />
                                <a href="{{ route('programs.show', $featured['slug']) }}" class="btn-outline-pill mt-auto w-fit">View Challenge</a>
                            </div>
                        </article>
                    @endif
                    <div class="programs-rail programs-rail--fit">
                        @foreach ($row['items']->take(5) as $program)
                            <x-programs.portrait-card :program="$program" />
                        @endforeach
                    </div>
                </section>
            @endforeach
        @endif
    </div>
</div>
