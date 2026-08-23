<?php

use App\Models\Recipe;
use App\Support\RecipeListing;
use Livewire\Attributes\Url;
use Livewire\Component;

new class extends Component
{
    #[Url]
    public string $q = '';

    #[Url]
    public string $collection = 'all';

    public bool $filtersOpen = false;

    public array $draftCourse = [];

    public array $draftConvenience = [];

    public array $draftPreference = [];

    public array $draftDietary = [];

    public array $draftTime = [];

    #[Url]
    public array $course = [];

    #[Url]
    public array $convenience = [];

    #[Url]
    public array $preference = [];

    #[Url]
    public array $dietary = [];

    #[Url]
    public array $time = [];

    public function toggleFilters(): void
    {
        $this->filtersOpen = ! $this->filtersOpen;
        if ($this->filtersOpen) {
            $this->draftCourse = $this->course;
            $this->draftConvenience = $this->convenience;
            $this->draftPreference = $this->preference;
            $this->draftDietary = $this->dietary;
            $this->draftTime = $this->time;
        }
    }

    public function applyFilters(): void
    {
        $this->course = $this->draftCourse;
        $this->convenience = $this->draftConvenience;
        $this->preference = $this->draftPreference;
        $this->dietary = $this->draftDietary;
        $this->time = $this->draftTime;
        $this->filtersOpen = false;
    }

    public function cancelFilters(): void
    {
        $this->draftCourse = $this->course;
        $this->draftConvenience = $this->convenience;
        $this->draftPreference = $this->preference;
        $this->draftDietary = $this->dietary;
        $this->draftTime = $this->time;
        $this->filtersOpen = false;
    }

    public function clearFilters(): void
    {
        $this->draftCourse = [];
        $this->draftConvenience = [];
        $this->draftPreference = [];
        $this->draftDietary = [];
        $this->draftTime = [];
        $this->course = [];
        $this->convenience = [];
        $this->preference = [];
        $this->dietary = [];
        $this->time = [];
    }

    public function selectCollection(string $key): void
    {
        $this->collection = $key === '' ? 'all' : $key;
    }

    public function hasActiveFilters(): bool
    {
        return $this->course !== []
            || $this->convenience !== []
            || $this->preference !== []
            || $this->dietary !== []
            || $this->time !== [];
    }

    public function hasDraftFilters(): bool
    {
        return $this->draftCourse !== []
            || $this->draftConvenience !== []
            || $this->draftPreference !== []
            || $this->draftDietary !== []
            || $this->draftTime !== [];
    }

    public function with(): array
    {
        $published = Recipe::query()->published()->orderBy('sort')->get();
        $items = $published;

        if ($this->q !== '') {
            $needle = mb_strtolower($this->q);
            $items = $items->filter(fn (Recipe $recipe) => str_contains(mb_strtolower((string) $recipe->title), $needle));
        }

        $items = $items->filter(fn (Recipe $recipe) => RecipeListing::matchesFilters(
            $recipe,
            $this->course,
            $this->convenience,
            $this->preference,
            $this->dietary,
            $this->time,
        ))->values();

        $catalog = RecipeListing::collections();
        $keys = $this->collection === 'all' || $this->collection === ''
            ? array_keys(array_filter($catalog, fn ($row) => $row['index']))
            : [$this->collection];

        $rows = [];
        foreach ($keys as $key) {
            $meta = $catalog[$key] ?? null;
            if ($meta === null) {
                continue;
            }
            $rowItems = RecipeListing::forCollection($items, $key);
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
        $showPopular = $this->collection === 'all' || $this->collection === '';

        $popular = [];
        if ($showPopular) {
            foreach (RecipeListing::popularCategories() as $tile) {
                $count = $published->where('category', $tile['category'])->count();
                if ($count === 0) {
                    continue;
                }
                $cover = $published->firstWhere('category', $tile['category']);
                $popular[] = [
                    'key' => $tile['key'],
                    'title' => $tile['title'],
                    'count' => $count,
                    'image' => $cover?->image,
                ];
            }
        }

        return [
            'allCount' => $items->count(),
            'browseOptions' => RecipeListing::browseOptions(),
            'showLatest' => $showLatest,
            'topLatest' => $topLatest,
            'popular' => $popular,
            'restRows' => $showLatest
                ? array_values(array_filter($rows, fn ($row) => $row['key'] !== 'latest'))
                : $rows,
            'courseOptions' => ['Appetizers', 'Breakfast', 'Desserts', 'Drinks', 'Mains', 'Salads', 'Side Dish', 'Snacks'],
            'convenienceOptions' => ['3 Ingredients Or Less', '5 Ingredients Or Less', 'Baking', 'Meal Prep', 'No-Cook', 'One Pan'],
            'preferenceOptions' => ['High Protein', 'Low Carb', 'Low Fat'],
            'dietaryOptions' => ['Dairy Free', 'Gluten Free', 'Pescatarian', 'Vegan', 'Vegetarian'],
            'timeOptions' => ['30 Mins or Less', '10 Mins or Less', '30 Mins +'],
        ];
    }
};
?>

<div class="recipes-listing">
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
                    <span class="sr-only">Search recipes</span>
                    <input
                        type="search"
                        wire:model.live.debounce.300ms="q"
                        placeholder="Search"
                        class="programs-search__input"
                    >
                </label>
                <span class="videos-fav" title="Sign in to save recipes">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M12 21s-7-4.4-7-10a4 4 0 017-2.6A4 4 0 0119 11c0 5.6-7 10-7 10z"/></svg>
                    <span class="videos-fav__label">Saved Recipes</span>
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
            <div class="programs-filters hidden lg:flex" id="recipe-filters">
                <div class="programs-filters__cols">
                    <div>
                        <h3 class="programs-filters__label">Course</h3>
                        @foreach ($courseOptions as $option)
                            <label class="programs-filters__option">
                                <input type="checkbox" wire:model="draftCourse" value="{{ $option }}">
                                {{ $option }}
                            </label>
                        @endforeach
                    </div>
                    <div>
                        <h3 class="programs-filters__label">Convenience</h3>
                        @foreach ($convenienceOptions as $option)
                            <label class="programs-filters__option">
                                <input type="checkbox" wire:model="draftConvenience" value="{{ $option }}">
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
                        <h3 class="programs-filters__label">Dietary Restriction</h3>
                        @foreach ($dietaryOptions as $option)
                            <label class="programs-filters__option">
                                <input type="checkbox" wire:model="draftDietary" value="{{ $option }}">
                                {{ $option }}
                            </label>
                        @endforeach
                    </div>
                    <div>
                        <h3 class="programs-filters__label">Total Time</h3>
                        @foreach ($timeOptions as $option)
                            <label class="programs-filters__option">
                                <input type="checkbox" wire:model="draftTime" value="{{ $option }}">
                                {{ $option }}
                            </label>
                        @endforeach
                    </div>
                </div>
                <div class="programs-filters__footer">
                    <button type="button" class="programs-filters__text {{ $this->hasActiveFilters() || $this->hasDraftFilters() ? '' : 'is-disabled' }}" wire:click="clearFilters" @disabled(! $this->hasActiveFilters() && ! $this->hasDraftFilters())>Clear Filters</button>
                    <div class="ml-auto flex items-center gap-4">
                        <button type="button" class="programs-filters__text" wire:click="cancelFilters">Cancel</button>
                        <button type="button" class="programs-filters__apply {{ $this->hasDraftFilters() ? '' : 'is-disabled' }}" wire:click="applyFilters">Apply</button>
                    </div>
                </div>
            </div>

            <div class="videos-filters-sheet lg:hidden" role="dialog" aria-label="Filters" x-data="{ open: '' }">
                <div class="videos-filters-sheet__head">
                    <h3 class="font-medium text-ink">Filters</h3>
                    <button type="button" class="text-2xl leading-none text-ink" wire:click="toggleFilters" aria-label="Close filters">&times;</button>
                </div>
                @foreach ([
                    'Course' => 'courseOptions',
                    'Convenience' => 'convenienceOptions',
                    'Preference' => 'preferenceOptions',
                    'Dietary Restriction' => 'dietaryOptions',
                    'Total Time' => 'timeOptions',
                ] as $label => $optionKey)
                    <div class="videos-filters-sheet__row">
                        <button type="button" class="videos-filters-sheet__toggle" @click="open = open === '{{ $label }}' ? '' : '{{ $label }}'">
                            {{ $label }}
                            <svg class="ui-icon ui-icon--chevron" viewBox="0 0 12 8" fill="none" aria-hidden="true"><path d="M1 1.5L6 6.5L11 1.5" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/></svg>
                        </button>
                        <div x-cloak x-show="open === '{{ $label }}'" class="videos-filters-sheet__body">
                            @foreach (${$optionKey} as $option)
                                @php
                                    $model = match ($optionKey) {
                                        'courseOptions' => 'draftCourse',
                                        'convenienceOptions' => 'draftConvenience',
                                        'preferenceOptions' => 'draftPreference',
                                        'dietaryOptions' => 'draftDietary',
                                        default => 'draftTime',
                                    };
                                @endphp
                                <label class="programs-filters__option">
                                    <input type="checkbox" wire:model="{{ $model }}" value="{{ $option }}">
                                    {{ $option }}
                                </label>
                            @endforeach
                        </div>
                    </div>
                @endforeach
                <div class="videos-filters-sheet__foot">
                    <button type="button" class="programs-filters__text {{ $this->hasActiveFilters() || $this->hasDraftFilters() ? '' : 'is-disabled' }}" wire:click="clearFilters">Clear Filters</button>
                    <button type="button" class="programs-filters__apply {{ $this->hasDraftFilters() ? '' : 'is-disabled' }}" wire:click="applyFilters">Apply</button>
                </div>
            </div>
        @else
            <div class="sr-only">
                <p>Course Convenience Preference Dietary Restriction Total Time</p>
            </div>
        @endif
    </div>

    <div class="site-container pb-16 pt-8">
        @if ($allCount === 0)
            <x-empty-state
                message="No recipes match these filters."
                hint="Try another collection or filter, or add recipes in the admin CMS."
            />
        @else
            @if ($showLatest && $topLatest)
                @php
                    $featured = $topLatest['items']->first();
                    $side = $topLatest['items']->slice(1, 1)->first();
                @endphp
                <section>
                    <div class="programs-row-head">
                        <h2 class="programs-h2">{{ $topLatest['title'] }}</h2>
                        <a href="{{ route('recipes', ['collection' => 'latest']) }}" class="programs-view-all max-lg:hidden">View All</a>
                        <a href="{{ route('recipes', ['collection' => 'latest']) }}" class="programs-view-all-link lg:hidden">View All</a>
                    </div>
                    <div class="recipes-latest">
                        @if ($featured)
                            <x-recipes.portrait-card :recipe="$featured" :featured="true" />
                        @endif
                        @if ($side)
                            <div class="max-lg:hidden">
                                <x-recipes.portrait-card :recipe="$side" />
                            </div>
                        @endif
                    </div>
                    <p class="videos-load-more" aria-disabled="true">Load More Latest Recipes</p>
                </section>
            @endif

            @if ($popular !== [])
                <section class="programs-collection">
                    <h2 class="programs-h2">Popular Categories</h2>
                    <div class="recipes-popular">
                        @foreach ($popular as $tile)
                            <a href="{{ route('recipes', ['collection' => $tile['key']]) }}" class="recipes-popular__tile">
                                <img
                                    src="{{ \App\Support\Media::url($tile['image'] ?? null) }}"
                                    alt=""
                                    class="recipes-popular__img"
                                    loading="lazy"
                                >
                                <span>
                                    <span class="recipes-popular__title">{{ $tile['title'] }}</span>
                                    <span class="recipes-popular__count">{{ $tile['count'] }} {{ $tile['count'] === 1 ? 'recipe' : 'recipes' }}</span>
                                </span>
                            </a>
                        @endforeach
                    </div>
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
                        <a href="{{ route('recipes', ['collection' => $row['key']]) }}" class="programs-view-all max-lg:hidden">View All</a>
                        <a href="{{ route('recipes', ['collection' => $row['key']]) }}" class="programs-view-all-link lg:hidden">View All</a>
                    </div>
                    <div class="recipes-rail">
                        @foreach ($row['items']->take(4) as $recipe)
                            <x-recipes.portrait-card :recipe="$recipe" />
                        @endforeach
                    </div>
                </section>
            @endforeach

            @if ($this->collection === 'all' || $this->collection === '')
                <p class="videos-load-more mt-12" aria-disabled="true">View All Recipes</p>
            @endif
        @endif
    </div>
</div>
