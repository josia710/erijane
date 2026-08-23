<?php

use App\Support\CommunityListing;
use Livewire\Attributes\Url;
use Livewire\Component;

new class extends Component
{
    #[Url]
    public string $channel = 'fitness';

    #[Url]
    public string $q = '';

    #[Url]
    public string $sort = 'latest';

    #[Url]
    public string $tag = 'All';

    #[Url]
    public int $page = 1;

    public bool $searchOpen = false;

    public function mount(): void
    {
        $slugs = collect(CommunityListing::channels())->pluck('slug');
        if (! $slugs->contains($this->channel)) {
            $this->channel = 'fitness';
        }
        if (! in_array($this->sort, ['latest', 'active'], true)) {
            $this->sort = 'latest';
        }
        if (! in_array($this->tag, CommunityListing::tags(), true)) {
            $this->tag = 'All';
        }
        if ($this->q !== '') {
            $this->searchOpen = true;
        }
        $this->page = max(1, $this->page);
    }

    public function selectChannel(string $slug): void
    {
        $this->channel = $slug;
        $this->page = 1;
    }

    public function selectSort(string $sort): void
    {
        $this->sort = $sort === 'active' ? 'active' : 'latest';
        $this->page = 1;
    }

    public function selectTag(string $tag): void
    {
        $this->tag = $tag;
        $this->page = 1;
    }

    public function toggleSearch(): void
    {
        $this->searchOpen = ! $this->searchOpen;
    }

    public function updatedQ(): void
    {
        $this->page = 1;
        if ($this->q !== '') {
            $this->searchOpen = true;
        }
    }

    public function nextPage(): void
    {
        if ($this->page < $this->pageCount()) {
            $this->page++;
        }
    }

    public function prevPage(): void
    {
        $this->page = max(1, $this->page - 1);
    }

    public function pageCount(): int
    {
        return max(1, (int) ceil($this->threads()->count() / CommunityListing::PER_PAGE));
    }

    /**
     * @return \Illuminate\Support\Collection<int, array<string, mixed>>
     */
    public function threads(): \Illuminate\Support\Collection
    {
        return CommunityListing::visible($this->channel, $this->q, $this->sort, $this->tag);
    }

    /**
     * @return \Illuminate\Support\Collection<int, array<string, mixed>>
     */
    public function pagedThreads(): \Illuminate\Support\Collection
    {
        $this->page = min($this->page, $this->pageCount());

        return $this->threads()
            ->slice(($this->page - 1) * CommunityListing::PER_PAGE, CommunityListing::PER_PAGE)
            ->values();
    }
};
?>

<div class="forum-listing">
    <span class="sr-only">Forum UI shell only — posting is not connected yet.</span>
    <div class="forum-shell">
        <aside class="forum-shell__nav" aria-label="Channels">
            <h2 class="forum-shell__heading">Community</h2>
            <ul class="forum-channels">
                @foreach (\App\Support\CommunityListing::channels() as $row)
                    <li>
                        <button
                            type="button"
                            wire:click="selectChannel('{{ $row['slug'] }}')"
                            class="forum-channel {{ $channel === $row['slug'] ? 'forum-channel--active' : '' }}"
                        >
                            <x-community.channel-icon :name="$row['icon']" />
                            {{ $row['label'] }}
                        </button>
                    </li>
                @endforeach
            </ul>
            <div class="forum-tools" aria-hidden="true">
                <span class="forum-tool">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M7 7h10v12l-5-3-5 3V7z"/></svg>
                </span>
                <span class="forum-tool">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M5 6h14v10H8l-3 3V6z"/></svg>
                </span>
                <span class="forum-tool">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M5 8h10v8H8l-3 3V8zM15 10h4v6l-2 1"/></svg>
                </span>
                <span class="forum-tool">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="12" r="3"/><path d="M12 3v2M12 19v2M5 12H3M21 12h-2M6.2 6.2l1.4 1.4M16.4 16.4l1.4 1.4M17.8 6.2l-1.4 1.4M7.6 16.4l-1.4 1.4"/></svg>
                </span>
            </div>
        </aside>

        <div class="forum-shell__main">
            <div class="forum-main__top">
                <div class="relative lg:hidden" x-data="{ open: false }" @click.outside="open = false">
                    <button
                        type="button"
                        class="forum-channel-select"
                        @click="open = !open"
                        :aria-expanded="open"
                    >
                        {{ \App\Support\CommunityListing::channelLabel($channel) }}
                        <svg class="ui-icon ui-icon--chevron" viewBox="0 0 12 8" fill="none" aria-hidden="true"><path d="M1 1.5L6 6.5L11 1.5" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/></svg>
                    </button>
                    <ul x-cloak x-show="open" class="programs-browse-menu forum-channel-menu" role="listbox">
                        @foreach (\App\Support\CommunityListing::channels() as $row)
                            <li>
                                <button
                                    type="button"
                                    wire:click="selectChannel('{{ $row['slug'] }}')"
                                    @click="open = false"
                                    class="programs-browse-item {{ $channel === $row['slug'] ? 'is-active' : '' }}"
                                >{{ $row['label'] }}</button>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <h1 class="forum-channel-title hidden lg:block">{{ \App\Support\CommunityListing::channelLabel($channel) }}</h1>

                <div class="forum-main__actions">
                    @if ($searchOpen)
                        <label class="forum-search-field">
                            <svg class="ui-icon ui-icon--search" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><circle cx="11" cy="11" r="7"/><path d="M20 20l-3-3"/></svg>
                            <span class="sr-only">Search posts</span>
                            <input
                                type="search"
                                wire:model.live.debounce.300ms="q"
                                placeholder="Search posts"
                                class="forum-search-field__input"
                            >
                        </label>
                    @else
                        <button type="button" class="forum-search-btn" wire:click="toggleSearch">
                            <svg class="ui-icon ui-icon--search" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><circle cx="11" cy="11" r="7"/><path d="M20 20l-3-3"/></svg>
                            <span class="hidden sm:inline">Search</span>
                        </button>
                    @endif
                    <a href="{{ route('login') }}" class="forum-create-post hidden lg:inline-flex">Create Post</a>
                </div>
            </div>

            <div class="forum-sort">
                <div class="forum-sort-toggle" role="group" aria-label="Sort">
                    <button
                        type="button"
                        class="{{ $sort === 'latest' ? 'is-active' : '' }}"
                        wire:click="selectSort('latest')"
                    >Latest</button>
                    <button
                        type="button"
                        class="{{ $sort === 'active' ? 'is-active' : '' }}"
                        wire:click="selectSort('active')"
                    >Last Active</button>
                </div>

                <div class="relative ml-auto hidden lg:block" x-data="{ open: false }" @click.outside="open = false">
                    <button
                        type="button"
                        class="forum-all-btn"
                        @click="open = !open"
                        :aria-expanded="open"
                    >
                        {{ $tag }}
                        <svg class="ui-icon ui-icon--chevron" viewBox="0 0 12 8" fill="none" aria-hidden="true"><path d="M1 1.5L6 6.5L11 1.5" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/></svg>
                    </button>
                    <ul x-cloak x-show="open" x-transition.opacity.duration.300ms class="programs-browse-menu forum-all-menu" role="listbox">
                        @foreach (\App\Support\CommunityListing::tags() as $option)
                            <li>
                                <button
                                    type="button"
                                    wire:click="selectTag('{{ $option }}')"
                                    @click="open = false"
                                    class="programs-browse-item {{ $tag === $option ? 'is-active' : '' }}"
                                >{{ $option }}</button>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="relative ml-auto lg:hidden" x-data="{ open: false }" @click.outside="open = false">
                    <button type="button" class="forum-all-btn forum-all-btn--icon" @click="open = !open" aria-label="Filter tags">
                        <svg class="ui-icon ui-icon--filters" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M4 7h16M7 12h10M10 17h4"/></svg>
                    </button>
                    <ul x-cloak x-show="open" x-transition.opacity.duration.300ms class="programs-browse-menu forum-all-menu" role="listbox">
                        @foreach (\App\Support\CommunityListing::tags() as $option)
                            <li>
                                <button
                                    type="button"
                                    wire:click="selectTag('{{ $option }}')"
                                    @click="open = false"
                                    class="programs-browse-item {{ $tag === $option ? 'is-active' : '' }}"
                                >{{ $option }}</button>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            @if ($this->pagedThreads()->isEmpty())
                <p class="forum-empty">No posts in this channel yet.</p>
            @else
                <div class="forum-feed" wire:key="feed-{{ $channel }}-{{ $sort }}-{{ $tag }}-{{ $q }}-{{ $page }}">
                    @foreach ($this->pagedThreads() as $thread)
                        <x-community.thread-card :thread="$thread" />
                    @endforeach
                </div>
                <div class="forum-pager">
                    <button type="button" class="forum-pager__btn" wire:click="prevPage" @disabled($page <= 1)>Previous</button>
                    <button type="button" class="forum-pager__btn" wire:click="nextPage" @disabled($page >= $this->pageCount())>Next</button>
                </div>
            @endif
        </div>
    </div>

    <a href="{{ route('login') }}" class="forum-fab lg:hidden">+ New Post</a>
</div>
