<?php

use App\Models\Recipe;
use Livewire\Attributes\Url;
use Livewire\Component;

new class extends Component
{
    #[Url]
    public string $category = 'All';

    public function mount(): void
    {
        if (request()->filled('category')) {
            $this->category = request('category');
        }
    }

    public function with(): array
    {
        $items = Recipe::query()->published()->orderBy('sort')->get();

        if ($this->category !== 'All') {
            $items = $items->where('category', $this->category)->values();

            return [
                'featured' => $items->first(),
                'secondary' => $items->slice(1, 1)->first(),
                'recipes' => $items->slice(2)->values(),
                'rows' => collect(),
                'allCount' => $items->count(),
                'categories' => ['All', 'High Protein', 'Low Carb', 'Dairy Free', 'Vegetarian'],
            ];
        }

        $featured = $items->first();
        $secondary = $items->slice(1, 1)->first();
        $rest = $items->slice(2)->values();

        $rows = $rest
            ->groupBy('category')
            ->map(fn ($group, $name) => [
                'title' => $name,
                'items' => $group->take(4)->values(),
            ])
            ->values();

        return [
            'featured' => $featured,
            'secondary' => $secondary,
            'recipes' => collect(),
            'rows' => $rows,
            'allCount' => $items->count(),
            'categories' => ['All', 'High Protein', 'Low Carb', 'Dairy Free', 'Vegetarian'],
        ];
    }
};
?>

<div>
    <div class="listing-toolbar">
        <span class="filter-chip">Saved Recipes</span>
        <div class="ml-auto flex flex-wrap gap-2">
            <span class="filter-chip">Search</span>
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
            message="No recipes in this category."
            hint="Try another filter or add recipes in the admin CMS."
        />
    @else
        <div class="mb-6 flex items-end justify-between gap-4">
            <div>
                <h1 class="listing-title">Latest Recipes</h1>
                <p class="mt-1 text-sm text-muted">Try something new for your next meal prep.</p>
            </div>
            <span class="btn-ghost pointer-events-none text-sm">View All</span>
        </div>

        @if ($featured)
            <div class="recipe-featured">
                <a href="{{ route('recipes.show', $featured['slug']) }}" class="recipe-featured__hero group">
                    <div class="overflow-hidden rounded-[10px]">
                        <img
                            src="{{ \App\Support\Media::url($featured['image'] ?? null) }}"
                            alt="{{ \App\Support\Media::alt($featured['title'] ?? null, 'Recipe') }}"
                            class="recipe-list-card__img h-56 sm:h-72"
                            loading="eager"
                        >
                    </div>
                    <p class="mt-3 text-xs text-muted">{{ $featured['category'] }} · {{ $featured['time'] }}</p>
                    <h2 class="mt-1 font-display text-lg font-semibold text-ink group-hover:underline">{{ $featured['title'] }}</h2>
                    <span class="mt-2 inline-flex items-center gap-1 text-sm font-medium text-ink">View Full Recipe
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 6l6 6-6 6"/></svg>
                    </span>
                </a>

                @if ($secondary)
                    <a href="{{ route('recipes.show', $secondary['slug']) }}" class="group block">
                        <div class="overflow-hidden rounded-[10px]">
                            <img
                                src="{{ \App\Support\Media::url($secondary['image'] ?? null) }}"
                                alt="{{ \App\Support\Media::alt($secondary['title'] ?? null, 'Recipe') }}"
                                class="recipe-list-card__img h-44 sm:h-56"
                                loading="lazy"
                            >
                        </div>
                        <p class="mt-3 text-xs text-muted">{{ $secondary['category'] }} · {{ $secondary['time'] }}</p>
                        <h3 class="mt-1 font-display text-sm font-semibold text-ink group-hover:underline">{{ $secondary['title'] }}</h3>
                    </a>
                @endif
            </div>

            <button type="button" class="btn-ghost mt-8 w-full cursor-default" disabled aria-disabled="true">
                Load More Latest Recipes
            </button>
        @endif

        @if ($this->category === 'All' && $rows->isNotEmpty())
            @foreach ($rows as $row)
                <section class="mt-12">
                    <div class="mb-6 flex items-end justify-between gap-4">
                        <div>
                            <h2 class="listing-title">{{ $row['title'] }}</h2>
                            <p class="mt-1 text-sm text-muted">Recipes in this collection.</p>
                        </div>
                        <button
                            type="button"
                            class="btn-ghost text-sm"
                            wire:click="$set('category', '{{ $row['title'] }}')"
                        >View All</button>
                    </div>
                    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                        @foreach ($row['items'] as $recipe)
                            <a href="{{ route('recipes.show', $recipe['slug']) }}" class="group block">
                                <div class="overflow-hidden rounded-[10px]">
                                    <img
                                        src="{{ \App\Support\Media::url($recipe['image'] ?? null) }}"
                                        alt="{{ \App\Support\Media::alt($recipe['title'] ?? null, 'Recipe') }}"
                                        class="recipe-list-card__img"
                                        loading="lazy"
                                    >
                                </div>
                                <p class="mt-2 text-xs text-muted">{{ $recipe['time'] }}</p>
                                <h3 class="mt-1 font-display text-sm font-semibold text-ink group-hover:underline">{{ $recipe['title'] }}</h3>
                            </a>
                        @endforeach
                    </div>
                </section>
            @endforeach
        @elseif ($recipes->isNotEmpty())
            <div class="mt-12 grid gap-8 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                @foreach ($recipes as $recipe)
                    <a href="{{ route('recipes.show', $recipe['slug']) }}" class="group block cursor-pointer">
                        <div class="overflow-hidden rounded-[10px]">
                            <img
                                src="{{ \App\Support\Media::url($recipe['image'] ?? null) }}"
                                alt="{{ \App\Support\Media::alt($recipe['title'] ?? null, 'Recipe') }}"
                                class="recipe-list-card__img"
                                loading="lazy"
                            >
                        </div>
                        <div class="mt-3">
                            <p class="text-xs text-muted">{{ $recipe['category'] }} · {{ $recipe['time'] }}</p>
                            <h3 class="mt-1 font-display text-sm font-semibold text-ink group-hover:underline">{{ $recipe['title'] }}</h3>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
    @endif
</div>
