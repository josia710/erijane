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
            <div class="mt-6 flex flex-wrap items-center gap-3">
                <a href="{{ route('signup') }}" class="btn-pill">Save Recipe</a>
                <a href="{{ route('recipes') }}" class="btn-outline-pill">More Recipes</a>
            </div>
        </div>
    </div>

    @php
        $relatedRecipes = \App\Models\Recipe::query()
            ->published()
            ->where('id', '!=', $recipe['id'])
            ->when($recipe['category'], fn ($q) => $q->where('category', $recipe['category']))
            ->orderBy('sort')
            ->take(4)
            ->get();
        if ($relatedRecipes->count() < 4) {
            $relatedRecipes = \App\Models\Recipe::query()
                ->published()
                ->where('id', '!=', $recipe['id'])
                ->orderBy('sort')
                ->take(4)
                ->get();
        }
    @endphp
    @if ($relatedRecipes->isNotEmpty())
        <section class="mt-16">
            <div class="programs-row-head">
                <h2 class="programs-h2">Related Recipes</h2>
                <a href="{{ route('recipes') }}" class="programs-view-all max-lg:hidden">View All</a>
                <a href="{{ route('recipes') }}" class="programs-view-all-link lg:hidden">View All</a>
            </div>
            <div class="recipes-rail mt-5 lg:hidden">
                @foreach ($relatedRecipes as $rel)
                    <x-recipes.portrait-card :recipe="$rel" />
                @endforeach
            </div>
            <div class="recipes-rail mt-5 max-lg:hidden">
                @foreach ($relatedRecipes as $rel)
                    <x-recipes.portrait-card :recipe="$rel" />
                @endforeach
            </div>
        </section>
    @endif
</div>
@endsection
