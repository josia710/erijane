@php
    $a = \App\Support\SiteContent::assets();
    $hero = \App\Support\SiteContent::section('home', 'hero');
@endphp

<section
    class="home-hero overflow-hidden bg-white md:bg-cover md:bg-center md:bg-no-repeat lg:h-[572px]"
    style="--hero-bg: url('{{ \App\Support\Media::url($a['hero_bg'] ?? null) }}')"
>
    <div class="home-hero__inner">
        <div class="home-hero__copy home-reveal">
            <img src="{{ \App\Support\Media::url($a['app_icon'] ?? null) }}" alt="App icon" class="home-hero__icon">
            <h1 class="home-hero__title">{{ $hero?->title ?? 'Available Now' }}</h1>
            <p class="home-hero__sub">{{ $hero?->body ?? 'Download for free on the app stores' }}</p>
            <div class="home-hero__stores">
                <a href="https://play.google.com" target="_blank" rel="noopener">
                    <img src="{{ \App\Support\Media::url($a['google'] ?? null) }}" alt="Get it on Google Play" class="home-hero__store">
                </a>
                <a href="https://www.apple.com/app-store/" target="_blank" rel="noopener">
                    <img src="{{ \App\Support\Media::url($a['apple'] ?? null) }}" alt="Download on the App Store" class="home-hero__store">
                </a>
            </div>
        </div>

        <div class="hero-collage home-reveal" data-hero-collage aria-hidden="true">
            <div class="hero-collage__piece hero-collage__piece--performance">
                <img src="{{ \App\Support\Media::url($a['performance'] ?? null) }}" alt="" class="hero-collage__img">
            </div>
            <div class="hero-collage__piece hero-collage__piece--monitor">
                <img src="{{ \App\Support\Media::url($a['monitor'] ?? null) }}" alt="" class="hero-collage__img">
            </div>
            <div class="hero-collage__piece hero-collage__piece--banner" data-hero-banner>
                <img src="{{ \App\Support\Media::url($a['banner'] ?? null) }}" alt="" class="hero-collage__img">
            </div>
            <div class="hero-collage__piece hero-collage__piece--connect">
                <img src="{{ \App\Support\Media::url($a['connect'] ?? null) }}" alt="" class="hero-collage__img">
            </div>
            <div class="hero-collage__piece hero-collage__piece--kcal-out">
                <img src="{{ \App\Support\Media::url($a['track_kcal_out'] ?? null) }}" alt="" class="hero-collage__img">
            </div>
            <div class="hero-collage__piece hero-collage__piece--kcal-in">
                <img src="{{ \App\Support\Media::url($a['track_kcal_in'] ?? null) }}" alt="" class="hero-collage__img">
            </div>
            <div class="hero-collage__piece hero-collage__piece--organize">
                <img src="{{ \App\Support\Media::url($a['organize'] ?? null) }}" alt="" class="hero-collage__img">
            </div>
            <div class="hero-collage__piece hero-collage__piece--train">
                <img src="{{ \App\Support\Media::url($a['train'] ?? null) }}" alt="" class="hero-collage__img">
            </div>
        </div>

        <img
            src="{{ \App\Support\Media::url($a['banner'] ?? null) }}"
            alt="{{ $hero?->title ?? 'Erijane app' }}"
            class="home-hero__mobile-banner"
        >
    </div>
</section>
