@extends('layouts.app')

@section('title', 'About - Erijane')

@section('content')
@php
    $sections = \App\Support\SiteContent::sections('about');
    $intro = $sections->firstWhere('section_key', 'intro');
    $story = $sections->firstWhere('section_key', 'story');
    $values = $sections->firstWhere('section_key', 'values');
    $disclaimer = $sections->firstWhere('section_key', 'disclaimer');
    $listSections = $sections->whereIn('section_key', ['mission', 'vision', 'impact'])->values();
    $valueItems = is_array($values?->meta['items'] ?? null) ? $values->meta['items'] : [];
    $assets = \App\Support\SiteContent::assets();
    $heroImg = \App\Support\Media::url($assets['about_header'] ?? $assets['banner'] ?? 'images/chloe/hero/erijane-about-header.png');
    $storyImg = \App\Support\Media::url($assets['train'] ?? 'images/chloe/hero/train.ff560bfb.png');
    $closeImg = \App\Support\Media::url($assets['about_close'] ?? $assets['performance'] ?? 'images/chloe/hero/erijane-about-close.png');
@endphp
<div class="about-page">
    <div class="site-container">
        <section class="about-hero home-reveal">
            <div class="about-hero__copy">
                <p class="about-hero__name">{{ $intro?->title ?: 'Erijane' }}</p>
                <p class="about-hero__role">Affordable fitness apparel · community motivation</p>
            </div>
            <div class="about-hero__media">
                <img
                    src="{{ $heroImg }}"
                    alt="Erijane"
                    class="about-hero__img"
                    loading="eager"
                >
            </div>
            @if ($intro?->body)
                <p class="about-hero__bio whitespace-pre-line">{{ $intro->body }}</p>
            @endif
        </section>

        @if ($story?->body)
            <section class="about-story home-reveal">
                <img
                    src="{{ $storyImg }}"
                    alt=""
                    class="about-story__img"
                    loading="lazy"
                >
                <p class="about-story__body whitespace-pre-line">{{ $story->body }}</p>
            </section>
        @endif

        @if ($values && $valueItems !== [])
            <section class="about-awards home-reveal">
                <h2 class="about-awards__title">{{ $values->title }}</h2>
                <div class="about-awards__grid">
                    <div class="about-awards__art">
                        <img
                            src="{{ \App\Support\Media::url('images/chloe/ui/chloeting-clapping.3227cd05.svg') }}"
                            alt=""
                            class="about-awards__art-img"
                        >
                    </div>
                    <div class="about-awards__cards">
                        @foreach ($valueItems as $item)
                            <article class="about-award">
                                <p class="about-award__label">{{ $item['label'] ?? '' }}</p>
                                <p class="about-award__text">{{ $item['text'] ?? '' }}</p>
                            </article>
                        @endforeach
                    </div>
                </div>
                @if ($listSections->isNotEmpty())
                    <div class="about-list">
                        <ul class="about-list__items">
                            @foreach ($listSections as $section)
                                <li class="about-list__item">
                                    <p>{{ $section->title }}</p>
                                    @if ($section->body)
                                        <p class="about-list__body whitespace-pre-line">{{ $section->body }}</p>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </section>
        @elseif ($listSections->isNotEmpty())
            <div class="about-list">
                <ul class="about-list__items">
                    @foreach ($listSections as $section)
                        <li class="about-list__item">
                            <p>{{ $section->title }}</p>
                            @if ($section->body)
                                <p class="about-list__body whitespace-pre-line">{{ $section->body }}</p>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif

        <section class="about-closing home-reveal">
            <div class="about-closing__media">
                <img
                    src="{{ $closeImg }}"
                    alt=""
                    class="about-closing__img"
                    loading="lazy"
                >
            </div>
            <div class="about-closing__copy">
                <p class="about-closing__quote">Ok that&apos;s it. Do your workouts, stay consistent, and remember to engage that core!</p>
                <p class="about-closing__sign">— Erijane</p>
            </div>
        </section>

        @if ($disclaimer?->body)
            <p class="about-note">{{ $disclaimer->body }}</p>
        @endif
    </div>
</div>
@endsection
