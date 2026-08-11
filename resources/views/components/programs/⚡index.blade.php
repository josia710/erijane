<?php

use App\Models\Program;
use Livewire\Attributes\Url;
use Livewire\Component;

new class extends Component
{
    #[Url]
    public string $level = 'All';

    #[Url]
    public string $focus = 'All';

    public string $q = '';

    public function clearFilters(): void
    {
        $this->level = 'All';
        $this->focus = 'All';
    }

    public function with(): array
    {
        $items = Program::query()->published()->orderBy('sort')->get();

        if ($this->level !== 'All') {
            $items = $items->where('level', $this->level);
        }

        if ($this->focus !== 'All') {
            $items = $items->where('focus', $this->focus);
        }

        if ($this->q !== '') {
            $needle = mb_strtolower($this->q);
            $items = $items->filter(fn ($p) => str_contains(mb_strtolower((string) $p['title']), $needle));
        }

        $items = $items->values();

        return [
            'featured' => $items->first(),
            'programs' => $items->slice(1)->values(),
            'allCount' => $items->count(),
            'levels' => ['All', 'Beginner', 'Intermediate', 'Advanced'],
            'focuses' => ['All', 'Core', 'Full Body', 'Tone', 'Lower Body', 'HIIT'],
        ];
    }
};
?>

<div>
    <div class="listing-toolbar">
        <label class="listing-search">
            <span class="sr-only">Search programs</span>
            <input
                type="search"
                wire:model.live.debounce.300ms="q"
                placeholder="Search by Collection..."
                class="listing-search__input"
            >
        </label>
        <button type="button" class="filter-chip" wire:click="$set('level', 'All')">Search</button>
        <button
            type="button"
            class="filter-chip {{ ($level !== 'All' || $focus !== 'All') ? 'filter-chip-active' : '' }}"
            wire:click="clearFilters"
        >Filters</button>
    </div>

    <div class="mt-6 mb-4 flex flex-wrap gap-2">
        @foreach ($levels as $levelOption)
            <button
                type="button"
                wire:click="$set('level', '{{ $levelOption }}')"
                class="filter-chip {{ $levelOption === $this->level ? 'filter-chip-active' : '' }}"
            >{{ $levelOption }}</button>
        @endforeach
    </div>
    <div class="mb-10 flex flex-wrap gap-2">
        @foreach ($focuses as $focusOption)
            <button
                type="button"
                wire:click="$set('focus', '{{ $focusOption }}')"
                class="filter-chip {{ $focusOption === $this->focus ? 'filter-chip-active' : '' }}"
            >{{ $focusOption }}</button>
        @endforeach
    </div>

    @if ($allCount === 0)
        <x-empty-state
            message="No programs match these filters."
            hint="Try another level or focus, or check back after new challenges are published."
        />
    @else
        <div class="mb-6 flex items-end justify-between gap-4">
            <div>
                <h2 class="listing-title">Latest Challenges</h2>
                <p class="mt-1 text-sm text-muted">Fresh programs to start your next stretch.</p>
            </div>
            <span class="btn-ghost pointer-events-none text-sm">View All</span>
        </div>

        @if ($featured)
            <div class="program-featured">
                <a href="{{ route('programs.show', $featured['slug']) }}" class="program-featured__hero group">
                    <div class="program-list-card__bed card-tone-{{ $featured['tone'] }}">
                        <div class="h-full min-h-72 overflow-hidden sm:min-h-[22rem]">
                            <img
                                src="{{ \App\Support\Media::url($featured['image'] ?? null) }}"
                                alt="{{ \App\Support\Media::alt($featured['title'] ?? null, 'Program') }}"
                                class="program-list-card__img h-full"
                                loading="eager"
                            >
                        </div>
                    </div>
                    <div class="program-featured__meta">
                        @if ($featured['badge'])
                            <span class="inline-block rounded bg-mint px-1.5 py-0.5 text-[10px] font-bold uppercase tracking-wide text-teal-800">{{ $featured['badge'] }}</span>
                        @endif
                        <h3 class="mt-2 font-display text-xl font-semibold text-ink group-hover:underline">{{ $featured['title'] }}</h3>
                        <p class="mt-2 text-sm text-muted">{{ $featured['weeks'] }} days · {{ $featured['level'] }} · {{ $featured['focus'] }}</p>
                        <span class="btn-pill mt-6 inline-flex">View Challenge</span>
                    </div>
                </a>

                @if ($programs->isNotEmpty())
                    <div class="program-featured__rail">
                        @foreach ($programs->take(3) as $program)
                            <a href="{{ route('programs.show', $program['slug']) }}" class="group block">
                                <div class="program-list-card__bed card-tone-{{ $program['tone'] }}">
                                    <div class="h-36 overflow-hidden">
                                        <img
                                            src="{{ \App\Support\Media::url($program['image'] ?? null) }}"
                                            alt="{{ \App\Support\Media::alt($program['title'] ?? null, 'Program') }}"
                                            class="program-list-card__img h-36"
                                            loading="lazy"
                                        >
                                    </div>
                                </div>
                                <h3 class="mt-2 font-display text-sm font-semibold text-ink group-hover:underline">{{ $program['title'] }}</h3>
                                <p class="text-xs text-muted">{{ $program['weeks'] }} days</p>
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>
        @endif

        @if ($programs->count() > 3)
            <div class="mt-12">
                <div class="mb-6 flex items-end justify-between gap-4">
                    <div>
                        <h2 class="listing-title">More Programs</h2>
                        <p class="mt-1 text-sm text-muted">Browse the full catalog.</p>
                    </div>
                </div>
                <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($programs->slice(3) as $program)
                        <a href="{{ route('programs.show', $program['slug']) }}" class="group cursor-pointer">
                            <div class="program-list-card__bed card-tone-{{ $program['tone'] }}">
                                <div class="h-72 overflow-hidden">
                                    <img
                                        src="{{ \App\Support\Media::url($program['image'] ?? null) }}"
                                        alt="{{ \App\Support\Media::alt($program['title'] ?? null, 'Program') }}"
                                        class="program-list-card__img"
                                        loading="lazy"
                                    >
                                </div>
                            </div>
                            <div class="mt-3 flex items-center gap-2">
                                @if ($program['badge'])
                                    <span class="inline-block rounded bg-mint px-1.5 py-0.5 text-[10px] font-bold uppercase tracking-wide text-teal-800">{{ $program['badge'] }}</span>
                                @endif
                                <h3 class="font-display text-sm font-semibold text-ink group-hover:underline">{{ $program['title'] }}</h3>
                            </div>
                            <p class="mt-0.5 text-xs text-muted">{{ $program['weeks'] }} weeks · {{ $program['level'] }}</p>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    @endif
</div>
