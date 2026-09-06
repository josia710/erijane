@extends('layouts.app')

@section('title', $program['title'].' - Erijane')

@section('content')
<div class="site-container py-12">
    <a href="{{ route('programs') }}" class="text-sm text-muted transition hover:text-ink">← All programs</a>
    <div class="mt-6 grid gap-8 lg:grid-cols-2 lg:items-center">
        <div class="overflow-hidden rounded-3xl card-tone-{{ $program['tone'] }}">
            <img
                src="{{ \App\Support\Media::url($program['image'] ?? null) }}"
                alt="{{ \App\Support\Media::alt($program['title'] ?? null, 'Program') }}"
                class="h-[28rem] w-full object-cover object-top lg:h-[32rem]"
            >
        </div>
        <div>
            @if ($program['badge'])
                <span class="inline-block rounded bg-mint px-2 py-0.5 text-[10px] font-bold uppercase tracking-wide text-teal-800">{{ $program['badge'] }}</span>
            @endif
            <h1 class="mt-4 font-display text-3xl font-semibold tracking-tight text-ink sm:text-4xl">{{ $program['title'] }}</h1>
            <p class="mt-3 text-base text-muted">{{ $program['weeks'] }} weeks · {{ $program['level'] }} · {{ $program['focus'] }}</p>
            <p class="mt-6 max-w-xl text-ink/80">
                Follow the daily schedule in the app. This local clone shows program detail UI without streaming workout videos.
            </p>
            <div class="mt-8 flex flex-wrap items-center gap-3">
                <a href="{{ route('signup') }}" class="btn-pill">Start program</a>
                @php $isDone = in_array($program['slug'], session()->get('completed_programs', []), true); @endphp
                <form method="POST" action="{{ route('programs.complete', $program) }}">
                    @csrf
                    <button type="submit" class="btn-outline-pill">{{ $isDone ? '✓ Completed — Undo' : 'Mark as complete' }}</button>
                </form>
            </div>

            <div class="mt-6 max-w-xl divide-y divide-border rounded-2xl border border-border">
                <details class="group px-5 py-4" open>
                    <summary class="flex cursor-pointer list-none items-center justify-between text-sm font-semibold text-ink">Program facts <span class="text-muted transition group-open:rotate-180">▾</span></summary>
                    <dl class="mt-3 space-y-1.5 text-sm">
                        <div class="flex gap-2"><dt class="w-24 shrink-0 text-xs font-semibold uppercase tracking-wide text-muted">Level</dt><dd class="text-ink">{{ $program['level'] }}</dd></div>
                        <div class="flex gap-2"><dt class="w-24 shrink-0 text-xs font-semibold uppercase tracking-wide text-muted">Focus</dt><dd class="text-ink">{{ implode(', ', \App\Support\ProgramListing::focusAreas($program)) }}</dd></div>
                        <div class="flex gap-2"><dt class="w-24 shrink-0 text-xs font-semibold uppercase tracking-wide text-muted">Equipment</dt><dd class="text-ink">{{ implode(', ', \App\Support\ProgramListing::equipment($program)) }}</dd></div>
                        <div class="flex gap-2"><dt class="w-24 shrink-0 text-xs font-semibold uppercase tracking-wide text-muted">Length</dt><dd class="text-ink">{{ $program['weeks'] }} weeks · {{ \App\Support\ProgramListing::days($program) }} days</dd></div>
                    </dl>
                </details>
            </div>
        </div>
    </div>

    @php
        $related = \App\Models\Program::query()
            ->published()
            ->where('id', '!=', $program['id'])
            ->orderBy('sort')
            ->take(5)
            ->get();
    @endphp
    @if ($related->isNotEmpty())
        <section class="mt-16">
            <div class="programs-row-head">
                <h2 class="programs-h2">Related Programs</h2>
                <a href="{{ route('programs') }}" class="programs-view-all max-lg:hidden">View All</a>
                <a href="{{ route('programs') }}" class="programs-view-all-link lg:hidden">View All</a>
            </div>
            <div class="programs-rail mt-5 lg:hidden">
                @foreach ($related as $rel)
                    <x-programs.portrait-card :program="$rel" />
                @endforeach
            </div>
            <div class="programs-rail programs-rail--fit mt-5 max-lg:hidden">
                @foreach ($related as $rel)
                    <x-programs.portrait-card :program="$rel" />
                @endforeach
            </div>
        </section>
    @endif
</div>
@endsection
