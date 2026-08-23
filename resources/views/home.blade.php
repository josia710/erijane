@extends('layouts.app')

@section('title', 'Erijane - Free Workout Programs')

@section('content')
@php
    $programs = \App\Models\Program::query()->published()->orderBy('sort')->take(3)->get();
    $videos = \App\Models\Video::query()->published()->orderBy('sort')->get();
    $recipes = \App\Models\Recipe::query()->published()->orderBy('sort')->take(4)->get();
    $store = \App\Models\Product::query()->published()->orderBy('sort')->get();
    $features = \App\Support\SiteContent::communityFeatures();
@endphp

<x-app-promo-hero />

{{-- Programs --}}
<section class="site-container py-14">
    <div class="mb-8 flex flex-wrap items-end justify-between gap-4">
        <h2 class="section-title">Free Workout Programs</h2>
        <a href="{{ route('programs') }}" class="btn-ghost">View All Programs</a>
    </div>
    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
        @foreach ($programs as $program)
            <a href="{{ route('programs.show', $program['slug']) }}" class="group cursor-pointer">
                <div class="overflow-hidden rounded-3xl card-tone-{{ $program['tone'] }}">
                    <div class="h-72 overflow-hidden">
                        <img src="{{ \App\Support\Media::url($program['image'] ?? null) }}" alt="{{ \App\Support\Media::alt($program['title'] ?? null, 'Program') }}" class="h-full w-full object-cover object-top transition duration-200 group-hover:scale-[1.03]">
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
</section>

{{-- Videos — Embla 4-up (live-style rounded thumbs + title/date) --}}
<section class="bg-surface py-14" data-home-carousel-section>
    <div class="site-container mb-8 flex flex-wrap items-end justify-between gap-4">
        <h2 id="videos-heading" class="section-title">Recent Workout Videos</h2>
        <div class="flex flex-wrap items-center gap-3">
            <button
                type="button"
                class="btn-ghost"
                data-home-autoplay-toggle
                aria-controls="videos-carousel"
                aria-label="Pause recent workout videos carousel"
                hidden
            >
                Pause
            </button>
            <a href="{{ route('videos') }}" class="btn-ghost">View All Workout Videos</a>
        </div>
    </div>
    <div
        id="videos-carousel"
        class="videos-carousel"
        data-home-carousel
        role="region"
        aria-roledescription="carousel"
        aria-labelledby="videos-heading"
    >
        <div class="embla__viewport">
            <div class="embla__container">
                @foreach ($videos as $video)
                    <div class="embla__slide">
                        <a href="{{ route('videos.show', $video['slug']) }}" class="group block cursor-pointer">
                            <div class="videos-carousel__thumb">
                                <img
                                    src="{{ \App\Support\Media::url($video['image'] ?? null) }}"
                                    alt="{{ \App\Support\Media::alt($video['title'] ?? null, 'Workout video') }}"
                                    class="h-full w-full object-cover transition duration-300 group-hover:scale-[1.03]"
                                    width="640"
                                    height="360"
                                >
                            </div>
                            <div class="mt-3 flex items-baseline justify-between gap-3">
                                <h3 class="font-display text-sm font-semibold text-ink group-hover:underline">{{ $video['title'] }}</h3>
                                <span class="shrink-0 text-xs text-muted">{{ $video['date'] }}</span>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- Merch — Embla (live parity: ant-carousel / slick peek) --}}
<section class="py-14" data-home-carousel-section>
    <div class="site-container mb-8 flex flex-wrap items-end justify-between gap-4">
        <h2 id="merch-heading" class="section-title">Merch</h2>
        <div class="flex flex-wrap items-center gap-3">
            <button
                type="button"
                class="btn-ghost"
                data-home-autoplay-toggle
                aria-controls="merch-carousel"
                aria-label="Pause merch carousel"
                hidden
            >
                Pause
            </button>
            <a href="{{ route('store') }}" class="btn-ghost">Visit Store</a>
        </div>
    </div>
    <div
        id="merch-carousel"
        class="merch-carousel"
        data-home-carousel
        role="region"
        aria-roledescription="carousel"
        aria-labelledby="merch-heading"
    >
        <div class="embla__viewport">
            <div class="embla__container">
                @foreach ($store as $item)
                    <div class="embla__slide">
                        <a href="{{ route('store.show', $item['slug']) }}" class="group block cursor-pointer">
                            <img src="{{ \App\Support\Media::url($item['image'] ?? null) }}" alt="{{ \App\Support\Media::alt($item['title'] ?? null, 'Product') }}" class="h-full w-full object-cover transition duration-300 group-hover:scale-[1.02]" width="300" height="399">
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- Recipes --}}
@php
    $featured = $recipes->first();
    $recipeCats = [
        ['label' => 'High Protein Recipes', 'cat' => 'High Protein', 'thumb' => 'images/chloe/recipes/high-protein-square.webp'],
        ['label' => 'Low Carb Recipes', 'cat' => 'Low Carb', 'thumb' => 'images/chloe/recipes/low-carb-square.webp'],
        ['label' => 'Dairy Free Recipes', 'cat' => 'Dairy Free', 'thumb' => 'images/chloe/recipes/dairy-free-square.webp'],
        ['label' => 'Vegetarian Recipes', 'cat' => 'Vegetarian', 'thumb' => 'images/chloe/recipes/vegetarian-square.webp'],
    ];
@endphp
<section class="bg-surface py-14">
    <div class="site-container">
        <div class="mb-8 flex flex-wrap items-end justify-between gap-4">
            <h2 class="section-title">Recipes</h2>
            <a href="{{ route('recipes') }}" class="btn-ghost">View More Recipes</a>
        </div>
        <div @class(['grid items-center gap-10', 'lg:grid-cols-2' => $featured])>
            @if ($featured)
            <a href="{{ route('recipes.show', $featured['slug']) }}" class="group flex items-center gap-5 sm:gap-6">
                <img src="{{ \App\Support\Media::url($featured['image'] ?? null) }}" alt="{{ \App\Support\Media::alt($featured['title'] ?? null, 'Recipe') }}" class="h-40 w-40 shrink-0 rounded-2xl object-cover shadow-sm sm:h-48 sm:w-48">
                <div>
                    <span class="inline-block rounded bg-mint px-2 py-0.5 text-[10px] font-bold uppercase tracking-wide text-teal-800">Latest Recipe</span>
                    <h3 class="mt-3 font-display text-xl font-semibold leading-snug text-ink sm:text-2xl">{{ $featured['title'] }}</h3>
                    <span class="mt-4 inline-flex items-center gap-1.5 text-sm font-medium text-ink group-hover:underline">
                        View Full Recipe
                        <span class="flex h-5 w-5 items-center justify-center rounded-full bg-ink text-white">
                            <svg class="h-3 w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14M13 6l6 6-6 6"/></svg>
                        </span>
                    </span>
                </div>
            </a>
            @endif
            {{-- Category list --}}
            <div class="divide-y divide-gray-200">
                @foreach ($recipeCats as $rc)
                    <a href="{{ route('recipes', ['category' => $rc['cat']]) }}" class="group flex items-center gap-4 py-3.5">
                        <img src="{{ \App\Support\Media::url($rc['thumb']) }}" alt="{{ $rc['label'] }}" class="h-12 w-12 shrink-0 rounded-lg object-cover">
                        <span class="font-display text-sm font-semibold text-ink group-hover:underline">{{ $rc['label'] }}</span>
                        <svg class="ml-auto h-4 w-4 text-muted transition group-hover:text-ink" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 6l6 6-6 6"/></svg>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- Community CTA --}}
@include('partials.community-cta', ['features' => $features])
@endsection
