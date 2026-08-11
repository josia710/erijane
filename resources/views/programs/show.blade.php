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
            <a href="{{ route('signup') }}" class="btn-pill mt-8">Start program</a>
        </div>
    </div>
</div>
@endsection
