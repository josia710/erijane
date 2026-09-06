@props(['slug'])

<span class="recipes-stars" role="group" aria-label="Rate this recipe">
    @for ($i = 1; $i <= 5; $i++)
        @if ($i === 2)
            <span class="recipes-stars__rest">
        @endif
        <button
            type="button"
            class="recipes-star"
            :class="((hover || $store.recipes.rating(@js($slug))) >= {{ $i }}) && 'is-on'"
            @mouseenter="hover = {{ $i }}"
            @mouseleave="hover = 0"
            @focus="hover = {{ $i }}"
            @blur="hover = 0"
            @click="$store.recipes.rate(@js($slug), {{ $i }})"
            :aria-label="'Rate {{ $i }} out of 5'"
            title="{{ $i }} of 5"
        >
            <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" aria-hidden="true"><path d="M12 3.2l2.4 4.9 5.4.8-3.9 3.8.9 5.4L12 15.8 7.2 18.1l.9-5.4L4.2 8.9l5.4-.8L12 3.2z"/></svg>
        </button>
        @if ($i === 5)
            </span>
        @endif
    @endfor
</span>
