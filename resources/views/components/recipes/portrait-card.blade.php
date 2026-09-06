@props([
    'recipe',
    'featured' => false,
])

@php
    $tags = \App\Support\RecipeListing::dietTags($recipe);
    $slug = $recipe['slug'];
@endphp

<div class="{{ $featured ? 'recipes-featured group' : 'recipes-card group' }}" x-data="{ hover: 0 }">
    <div class="{{ $featured ? 'recipes-featured__thumb' : 'recipes-card__thumb' }}">
        <a href="{{ route('recipes.show', $slug) }}" class="block h-full w-full" aria-label="{{ $recipe['title'] }}">
            <img
                src="{{ \App\Support\Media::url($recipe['image'] ?? null) }}"
                alt="{{ \App\Support\Media::alt($recipe['title'] ?? null, 'Recipe') }}"
                loading="{{ $featured ? 'eager' : 'lazy' }}"
                onload="this.classList.add('is-loaded')"
            >
        </a>
        @if (! $featured)
            <div class="recipes-card__overlay">
                <span class="recipes-rating-pill">
                    <x-recipes.stars :slug="$slug" />
                    <span
                        class="recipes-rating-value"
                        x-show="$store.recipes.rating(@js($slug)) > 0"
                        x-cloak
                        x-text="($store.recipes.rating(@js($slug))).toFixed(1)"
                    ></span>
                </span>
                <x-recipes.action-icons :slug="$slug" />
            </div>
        @endif
        @if ($tags !== [])
            <div class="recipes-tags" aria-label="Dietary tags">
                @foreach ($tags as $tag)
                    <span class="recipes-tag" aria-label="{{ $tag['label'] }}"><span class="recipes-tag__code" aria-hidden="true">{{ $tag['code'] }}</span><span class="recipes-tag__full" aria-hidden="true">{{ $tag['label'] }}</span></span>
                @endforeach
            </div>
        @endif
    </div>
    <div class="{{ $featured ? 'recipes-featured__body' : 'recipes-card__body' }}">
        <a href="{{ route('recipes.show', $slug) }}" class="recipes-card__link">
            <h3 class="{{ $featured ? 'recipes-featured__title' : 'recipes-card__title' }}">{{ $recipe['title'] }}</h3>
        </a>
        @if ($featured)
            <div class="recipes-featured__rate" role="group" aria-label="Rate this recipe">
                <x-recipes.stars :slug="$slug" />
                <span class="recipes-your-rating" x-show="$store.recipes.rating(@js($slug)) > 0" x-cloak>
                    You rated <span x-text="$store.recipes.rating(@js($slug))"></span>/5
                </span>
            </div>
            <div class="recipes-featured__cta">
                <a href="{{ route('recipes.show', $slug) }}" class="recipes-view-recipe">View Recipe</a>
                <x-recipes.action-icons :slug="$slug" />
            </div>
        @else
            <p class="recipes-card__time lg:hidden">{{ $recipe['time'] }}</p>
        @endif
    </div>
</div>
