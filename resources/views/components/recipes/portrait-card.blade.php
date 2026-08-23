@props([
    'recipe',
    'featured' => false,
])

@php
    $tags = \App\Support\RecipeListing::dietTags($recipe);
@endphp

<a href="{{ route('recipes.show', $recipe['slug']) }}" class="{{ $featured ? 'recipes-featured group' : 'recipes-card group' }}">
    <div class="{{ $featured ? 'recipes-featured__thumb' : 'recipes-card__thumb' }}">
        <img
            src="{{ \App\Support\Media::url($recipe['image'] ?? null) }}"
            alt="{{ \App\Support\Media::alt($recipe['title'] ?? null, 'Recipe') }}"
            loading="{{ $featured ? 'eager' : 'lazy' }}"
        >
        @if (! $featured)
            <span class="recipes-overlay">
                <span class="recipes-stars" aria-hidden="true">
                    @for ($i = 0; $i < 5; $i++)
                        <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M12 3.2l2.4 4.9 5.4.8-3.9 3.8.9 5.4L12 15.8 7.2 18.1l.9-5.4L4.2 8.9l5.4-.8L12 3.2z"/></svg>
                    @endfor
                </span>
                <x-recipes.action-icons />
            </span>
        @endif
        @if ($tags !== [])
            <div class="recipes-tags">
                @foreach ($tags as $tag)
                    <span class="recipes-tag" title="{{ $tag['label'] }}">{{ $tag['code'] }}</span>
                @endforeach
            </div>
        @endif
    </div>
    <div class="{{ $featured ? 'recipes-featured__body' : 'recipes-card__body' }}">
        <h3 class="{{ $featured ? 'recipes-featured__title' : 'recipes-card__title' }}">{{ $recipe['title'] }}</h3>
        @if ($featured)
            <span class="recipes-rating-chip" aria-hidden="true">
                <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M12 3.2l2.4 4.9 5.4.8-3.9 3.8.9 5.4L12 15.8 7.2 18.1l.9-5.4L4.2 8.9l5.4-.8L12 3.2z"/></svg>
            </span>
            <div class="recipes-featured__cta">
                <span class="recipes-view-recipe">View Recipe</span>
                <x-recipes.action-icons />
            </div>
        @endif
        @if (! $featured)
            <p class="recipes-card__time lg:hidden">{{ $recipe['time'] }}</p>
        @endif
    </div>
</a>
