@extends('layouts.app')

@section('title', 'About - Erijane')

@section('content')
@php
    $sections = \App\Support\SiteContent::sections('about');
    $hero = $sections->firstWhere('section_key', 'intro') ?? $sections->first();
    $rest = $sections->when($hero, fn ($c) => $c->reject(fn ($s) => $s->id === $hero->id))->values();
@endphp
<div>
    <section class="about-hero">
        <div class="site-container about-hero__grid">
            <div class="about-hero__copy">
                <h1 class="font-display text-4xl font-semibold tracking-tight text-ink sm:text-5xl">Erijane</h1>
                <p class="mt-2 text-base font-medium text-ink/70">Affordable fitness apparel · community motivation</p>
                @if ($hero?->body)
                    <p class="mt-6 max-w-xl text-sm leading-relaxed text-ink/80 whitespace-pre-line">{{ $hero->body }}</p>
                @else
                    <p class="mt-6 max-w-xl text-sm leading-relaxed text-ink/80">Confidence for every body — founded on authenticity, inclusivity, and real transformation stories.</p>
                @endif
            </div>
            <div class="about-hero__media">
                <img
                    src="{{ asset('images/chloe/hero/chloeting-banner.e2207dc5.png') }}"
                    alt="Erijane fitness inspiration"
                    class="about-hero__img"
                    loading="eager"
                >
            </div>
        </div>
    </section>

    <div class="site-container space-y-10 py-12 lg:py-16">
        @forelse ($rest as $section)
            <section class="about-panel">
                @if ($section->title)
                    <h2 class="listing-title">{{ $section->title }}</h2>
                @endif
                @if ($section->body)
                    <p class="mt-3 max-w-3xl whitespace-pre-line text-ink/80">{{ $section->body }}</p>
                @endif
                @if (! empty($section->meta['items']))
                    <ul class="mt-6 grid gap-3 sm:grid-cols-2 lg:grid-cols-3">
                        @foreach ($section->meta['items'] as $item)
                            <li class="rounded-2xl bg-sky/40 p-4 ring-1 ring-border">
                                <p class="font-display text-sm font-semibold text-ink">{{ $item['label'] ?? '' }}</p>
                                <p class="mt-1 text-sm text-muted">{{ $item['text'] ?? '' }}</p>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </section>
        @empty
            @unless ($hero)
                <section class="about-panel">
                    <h2 class="listing-title">Erijane</h2>
                    <p class="mt-3 text-ink/80">Content is managed in the admin CMS. Seed page sections to populate this page.</p>
                </section>
            @endunless
        @endforelse

        <section class="about-closing">
            <div class="about-closing__media">
                <img
                    src="{{ asset('images/chloe/hero/performance-audit.a8d696be.png') }}"
                    alt=""
                    class="about-closing__img"
                    loading="lazy"
                >
            </div>
            <div>
                <p class="font-display text-2xl font-semibold leading-snug text-ink sm:text-3xl">Ok that&apos;s it. Do your workouts, stay consistent, and remember to engage that core!</p>
                <p class="mt-4 font-display text-lg text-brand">— Erijane</p>
            </div>
        </section>
    </div>
</div>
@endsection
