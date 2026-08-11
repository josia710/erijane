@php
    $nav = \App\Support\SiteContent::nav();
    $socials = \App\Support\SiteContent::socials();
@endphp

<header class="sticky top-0 z-50 border-b border-border bg-surface">
    <div class="site-container grid h-14 grid-cols-[auto_1fr_auto] items-center gap-4 lg:grid-cols-[1fr_auto_1fr]">
        <a href="{{ route('home') }}" class="shrink-0 lg:justify-self-start" aria-label="Erijane home">
            <img src="{{ asset('images/erijane/wordmark-dark@2x.png') }}" alt="Erijane" width="149" height="28" class="h-7 w-auto">
        </a>

        <nav class="hidden items-center justify-center gap-5 lg:flex" aria-label="Primary">
            @foreach ($nav as $item)
                @php
                    $href = ($item['route'] === 'login' && auth()->check())
                        ? route('home')
                        : route($item['route']);
                @endphp
                <a
                    href="{{ $href }}"
                    class="nav-link {{ request()->routeIs($item['route']) ? 'nav-link-active' : '' }}"
                >{{ $item['label'] }}</a>
            @endforeach
        </nav>

        <div class="hidden items-center justify-end gap-3 lg:flex">
            @auth
                <span class="text-sm text-muted">Hi, {{ Auth::user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn-outline-pill">Log Out</button>
                </form>
            @else
                <a href="{{ route('signup') }}" class="btn-pill">Sign Up</a>
                <a href="{{ route('login') }}" class="btn-outline-pill">Log In</a>
            @endauth
        </div>

        <button
            id="mobile-menu-btn"
            type="button"
            class="col-start-3 inline-flex items-center justify-center rounded-lg border border-gray-200 p-2 lg:hidden"
            aria-controls="mobile-menu"
            aria-expanded="false"
            aria-label="Toggle menu"
        >
            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>
    </div>

    <div id="mobile-menu" class="hidden border-t border-border bg-surface lg:hidden">
        <div class="site-container flex flex-col gap-3 py-4">
            @foreach ($nav as $item)
                @php
                    $href = ($item['route'] === 'login' && auth()->check())
                        ? route('home')
                        : route($item['route']);
                @endphp
                <a href="{{ $href }}" class="nav-link py-1">{{ $item['label'] }}</a>
            @endforeach
            <div class="flex items-center gap-3 pt-2">
                @auth
                    <span class="text-sm text-muted">Hi, {{ Auth::user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn-outline-pill">Log Out</button>
                    </form>
                @else
                    <a href="{{ route('signup') }}" class="btn-pill">Sign Up</a>
                    <a href="{{ route('login') }}" class="btn-outline-pill">Log In</a>
                @endauth
            </div>
        </div>
    </div>
</header>
