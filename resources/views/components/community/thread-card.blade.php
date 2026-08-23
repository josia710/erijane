@props(['thread'])

<article class="forum-thread">
    <div class="forum-thread__meta">
        <div class="forum-thread__who">
            <span class="forum-thread__avatar" aria-hidden="true">{{ strtoupper(substr($thread['author'], 0, 1)) }}</span>
            <p class="forum-thread__author forum-thread__author--{{ $thread['tone'] }}">
                {{ $thread['author'] }}
                <svg class="forum-thread__badge" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 2l2.4 2.2H18l.4 3.6L21 10l-2.2 2.8.2 3.6-3.4.8L12 20l-3.6-2.8-3.4-.8.2-3.6L3 10l2.6-2.2L6 4.2h3.6L12 2z"/></svg>
            </p>
            <span class="forum-thread__when">{{ $thread['when'] }}</span>
        </div>
        <div class="forum-thread__tags">
            @if ($thread['pinned'])
                <span class="forum-tag forum-tag--pinned">
                    <svg class="h-3 w-3" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M14 3l7 7-1.5 1.5-2.2-.4-4.4 4.4V21h-2v-5.5L6.5 11.1l-.4-2.2L7.6 7.4 14 3z"/></svg>
                    Pinned
                </span>
            @endif
            <span class="forum-tag">
                @if ($thread['tag'] === 'Programs')
                    <svg class="h-3 w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><rect x="4" y="5" width="16" height="15" rx="2"/><path d="M8 3v4M16 3v4M4 10h16"/></svg>
                @else
                    <svg class="h-3 w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M5 6h14v10H8l-3 3V6z"/></svg>
                @endif
                {{ $thread['tag'] }}
            </span>
        </div>
    </div>

    <div class="forum-thread__heading">
        <h2 class="forum-thread__title">{{ $thread['title'] }}</h2>
        @if ($thread['new'])
            <span class="forum-tag forum-tag--new">NEW</span>
        @endif
    </div>
    <p class="forum-thread__snippet">{{ $thread['snippet'] }}</p>

    <div class="forum-thread__actions">
        <span class="forum-action" aria-hidden="true">
            <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M5 6h14v10H8l-3 3V6z"/></svg>
            <span class="sm:hidden">{{ $thread['replies'] }}</span>
            <span class="hidden sm:inline">{{ $thread['replies'] }} Replies</span>
        </span>
        <span class="forum-action forum-action--vote" aria-hidden="true">
            <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M12 5l6 8H6l6-8z"/></svg>
            {{ $thread['votes'] }}
            <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M12 19l-6-8h12l-6 8z"/></svg>
        </span>
        <button type="button" class="forum-action" disabled aria-disabled="true">
            <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M7 7h10v12l-5-3-5 3V7zM7 7V5a2 2 0 012-2h6a2 2 0 012 2v2"/></svg>
            <span class="hidden sm:inline">Save</span>
        </button>
        <button type="button" class="forum-action" disabled aria-disabled="true">
            <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M4 12v7h7M20 4h-7v7M20 4L10 14"/></svg>
            <span class="hidden sm:inline">Share</span>
        </button>
    </div>
</article>
