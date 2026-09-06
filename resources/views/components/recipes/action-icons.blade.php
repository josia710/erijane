@props(['slug'])

<span {{ $attributes->class('recipes-card__icons') }}>
    <button
        type="button"
        class="recipes-icon-btn"
        :class="$store.recipes.isSaved(@js($slug)) && 'is-active'"
        :aria-pressed="$store.recipes.isSaved(@js($slug))"
        :aria-label="$store.recipes.isSaved(@js($slug)) ? 'Remove from saved recipes' : 'Save this recipe'"
        :title="$store.recipes.isSaved(@js($slug)) ? 'Saved' : 'Save'"
        @click="$store.recipes.toggleSaved(@js($slug))"
    >
        <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M12 7v10M7 12h10"/></svg>
    </button>
    <button
        type="button"
        class="recipes-icon-btn recipes-heart-btn"
        :class="$store.recipes.isLiked(@js($slug)) && 'is-liked'"
        :aria-pressed="$store.recipes.isLiked(@js($slug))"
        :aria-label="$store.recipes.isLiked(@js($slug)) ? 'Unlike this recipe' : 'Like this recipe'"
        :title="$store.recipes.isLiked(@js($slug)) ? 'Liked' : 'Like'"
        @click="$store.recipes.toggleLiked(@js($slug))"
    >
        <svg class="recipes-heart" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M12 21s-7-4.4-7-10a4 4 0 017-2.6A4 4 0 0119 11c0 5.6-7 10-7 10z"/></svg>
    </button>
</span>
