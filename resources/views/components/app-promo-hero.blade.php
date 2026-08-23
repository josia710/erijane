@php
    $a = \App\Support\SiteContent::assets();
    $hero = \App\Support\SiteContent::section('home', 'hero');
@endphp

<section
    class="home-hero overflow-hidden bg-white md:bg-cover md:bg-center md:bg-no-repeat lg:h-[572px]"
    style="--hero-bg: url('{{ asset($a['hero_bg']) }}')"
>
    <div class="home-hero__inner">
        <div class="home-hero__copy home-reveal">
            <img src="{{ asset($a['app_icon']) }}" alt="App icon" class="home-hero__icon">
            <h1 class="home-hero__title">{{ $hero?->title ?? 'Available Now' }}</h1>
            <p class="home-hero__sub">{{ $hero?->body ?? 'Download for free on the app stores' }}</p>
            <div class="home-hero__stores">
                <a href="https://play.google.com" target="_blank" rel="noopener">
                    <img src="{{ asset($a['google']) }}" alt="Get it on Google Play" class="home-hero__store">
                </a>
                <a href="https://www.apple.com/app-store/" target="_blank" rel="noopener">
                    <img src="{{ asset($a['apple']) }}" alt="Download on the App Store" class="home-hero__store">
                </a>
            </div>
        </div>

        <div class="hero-collage home-reveal" data-hero-collage aria-hidden="true">
            <div class="hero-collage__piece hero-collage__piece--performance">
                <img src="{{ asset($a['performance']) }}" alt="" class="hero-collage__img">
            </div>
            <div class="hero-collage__piece hero-collage__piece--monitor">
                <img src="{{ asset($a['monitor']) }}" alt="" class="hero-collage__img">
            </div>
            <div class="hero-collage__piece hero-collage__piece--banner" data-hero-banner>
                <img src="{{ asset($a['banner']) }}" alt="" class="hero-collage__img">
            </div>
            <div class="hero-collage__piece hero-collage__piece--connect">
                <img src="{{ asset($a['connect']) }}" alt="" class="hero-collage__img">
            </div>
            <div class="hero-collage__piece hero-collage__piece--kcal-out">
                <img src="{{ asset($a['track_kcal_out']) }}" alt="" class="hero-collage__img">
            </div>
            <div class="hero-collage__piece hero-collage__piece--kcal-in">
                <img src="{{ asset($a['track_kcal_in']) }}" alt="" class="hero-collage__img">
            </div>
            <div class="hero-collage__piece hero-collage__piece--organize">
                <img src="{{ asset($a['organize']) }}" alt="" class="hero-collage__img">
            </div>
            <div class="hero-collage__piece hero-collage__piece--train">
                <img src="{{ asset($a['train']) }}" alt="" class="hero-collage__img">
            </div>
        </div>

        <img
            src="{{ asset($a['banner']) }}"
            alt="{{ $hero?->title ?? 'Erijane app' }}"
            class="home-hero__mobile-banner"
        >
    </div>
</section>
