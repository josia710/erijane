@php
    $channels = [
        ['slug' => 'fitness', 'label' => '#fitness', 'active' => true],
        ['slug' => 'before-after-results', 'label' => '#before-after-results', 'active' => false],
        ['slug' => 'fitness-journeys', 'label' => '#fitness-journeys', 'active' => false],
        ['slug' => 'food', 'label' => '#food', 'active' => false],
        ['slug' => 'off-topic', 'label' => '#off-topic', 'active' => false],
        ['slug' => 'feedback', 'label' => '#feedback', 'active' => false],
        ['slug' => 'tech-support', 'label' => '#tech-support', 'active' => false],
        ['slug' => 'looking-for-team', 'label' => '#looking-for-team', 'active' => false],
        ['slug' => 'announcements', 'label' => '#announcements', 'active' => false],
    ];

    $threads = [
        [
            'author' => 'erijane',
            'title' => 'Welcome to the Erijane community',
            'snippet' => 'Share wins, ask questions, and support each other — this board is a visual shell (no live posting yet).',
            'tags' => ['Pinned', 'Misc'],
            'when' => 'pinned',
        ],
        [
            'author' => 'coach',
            'title' => 'What program / workout should I do?',
            'snippet' => 'Start with a beginner-friendly challenge from Workout Programs, then layer videos for variety.',
            'tags' => ['Pinned', 'Programs'],
            'when' => '2 weeks ago',
        ],
        [
            'author' => 'community',
            'title' => 'Resources megathread',
            'snippet' => 'Recipes, form tips, and apparel care — bookmark this thread as we grow the catalog.',
            'tags' => ['Pinned', 'Misc'],
            'when' => '1 month ago',
        ],
        [
            'author' => 'member',
            'title' => 'Tips for staying on track',
            'snippet' => 'Small consistent sessions beat perfection. Track progress visually and celebrate non-scale wins.',
            'tags' => ['Misc', 'NEW'],
            'when' => '3 days ago',
        ],
    ];
@endphp

<section class="site-container pb-16" aria-label="Community discussions shell">
    <div class="forum-shell">
        <aside class="forum-shell__nav" aria-label="Channels">
            <h2 class="font-display text-lg font-semibold text-ink">Community</h2>
            <ul class="mt-4 space-y-1">
                @foreach ($channels as $channel)
                    <li>
                        <span @class([
                            'forum-channel',
                            'forum-channel--active' => $channel['active'],
                        ])>
                            {{ $channel['label'] }}
                        </span>
                    </li>
                @endforeach
            </ul>
            <p class="mt-6 text-xs text-muted">Forum UI shell only — posting is not connected yet.</p>
        </aside>

        <div class="forum-shell__main">
            <div class="flex flex-wrap items-center justify-between gap-3">
                <h2 class="font-display text-xl font-semibold text-ink">#fitness</h2>
                <div class="flex flex-wrap items-center gap-2">
                    <label class="forum-search">
                        <span class="sr-only">Search</span>
                        <input type="search" placeholder="Search" disabled class="forum-search__input" aria-disabled="true">
                    </label>
                    <button type="button" class="btn-pill cursor-not-allowed opacity-70" disabled aria-disabled="true">Create Post</button>
                </div>
            </div>

            <div class="mt-4 flex flex-wrap items-center gap-2">
                <span class="filter-chip filter-chip-active">Latest</span>
                <span class="filter-chip">Last Active</span>
                <span class="ml-auto filter-chip">All</span>
            </div>

            <ul class="mt-6 divide-y divide-border">
                @foreach ($threads as $thread)
                    <li class="forum-thread">
                        <div class="forum-thread__avatar" aria-hidden="true">{{ strtoupper(substr($thread['author'], 0, 1)) }}</div>
                        <div class="min-w-0 flex-1">
                            <div class="flex flex-wrap items-center gap-2">
                                <span class="text-sm font-semibold text-ink">{{ $thread['author'] }}</span>
                                <span class="text-xs text-muted">{{ $thread['when'] }}</span>
                                @foreach ($thread['tags'] as $tag)
                                    <span class="forum-tag">{{ $tag }}</span>
                                @endforeach
                            </div>
                            <h3 class="mt-1 font-display text-base font-semibold text-ink">{{ $thread['title'] }}</h3>
                            <p class="mt-1 text-sm text-muted">{{ $thread['snippet'] }}</p>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</section>
