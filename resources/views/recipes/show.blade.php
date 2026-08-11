@extends('layouts.app')

@section('title', $recipe['title'].' - Erijane')

@section('content')
<div class="site-container py-12">
    <a href="{{ route('recipes') }}" class="text-sm text-muted transition hover:text-ink">← All recipes</a>
    <div class="mt-6 grid gap-8 lg:grid-cols-2 lg:items-start">
        @if (! empty($recipe['image']))
            <img
                src="{{ \App\Support\Media::url($recipe['image'] ?? null) }}"
                alt="{{ \App\Support\Media::alt($recipe['title'] ?? null, 'Recipe') }}"
                class="h-80 w-full rounded-[10px] object-cover lg:h-[28rem]"
                loading="lazy"
            >
        @else
            <div class="h-80 rounded-[10px] card-tone-{{ $recipe['tone'] }} lg:h-[28rem]"></div>
        @endif
        <div>
            <p class="text-sm text-muted">{{ $recipe['category'] }} · {{ $recipe['time'] }}</p>
            <h1 class="mt-2 font-display text-3xl font-semibold tracking-tight text-ink">{{ $recipe['title'] }}</h1>
            <ol class="mt-6 list-decimal space-y-2 pl-5 text-ink/80">
                <li>Prep ingredients (demo steps).</li>
                <li>Cook according to your preferred method.</li>
                <li>Plate and enjoy after your workout.</li>
            </ol>
        </div>
    </div>
</div>
@endsection
