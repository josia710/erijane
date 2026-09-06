<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Erijane - Free Workout Programs')</title>
    <meta name="description" content="@yield('description', 'Erijane - free workout programs, healthy recipes and fitness plans. Local Laravel + Livewire study project.')">
    <link rel="icon" href="{{ asset('favicon.ico') }}" sizes="32x32">
    <link rel="apple-touch-icon" href="{{ asset('images/erijane/apple-touch-icon.png') }}">
    <meta name="application-name" content="Erijane">
    <meta name="theme-color" content="#026068">
    <meta property="og:site_name" content="Erijane">
    <meta property="og:type" content="website">
    <meta property="og:title" content="@yield('title', 'Erijane - Free Workout Programs')">
    <meta property="og:image" content="{{ asset('images/erijane/og-image.png') }}">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:image" content="{{ asset('images/erijane/og-image.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="min-h-screen flex flex-col">
    @include('partials.nav')

    @if (session('status'))
        <div class="site-container pt-4">
            <div class="rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800">
                {{ session('status') }}
            </div>
        </div>
    @endif

    <main class="flex-1">
        @yield('content')
    </main>

    @include('partials.footer')

    @livewireScripts
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const btn = document.getElementById('mobile-menu-btn');
            const menu = document.getElementById('mobile-menu');
            if (btn && menu) {
                btn.addEventListener('click', () => {
                    menu.classList.toggle('hidden');
                    const open = !menu.classList.contains('hidden');
                    btn.setAttribute('aria-expanded', open ? 'true' : 'false');
                });
            }

            document.querySelectorAll('[data-password-toggle]').forEach((toggle) => {
                toggle.addEventListener('click', () => {
                    const input = document.getElementById(toggle.getAttribute('data-password-toggle'));
                    if (!input) {
                        return;
                    }
                    const show = input.type === 'password';
                    input.type = show ? 'text' : 'password';
                    toggle.textContent = show ? 'Hide' : 'Show';
                    toggle.setAttribute('aria-label', show ? 'Hide password' : 'Show password');
                });
            });
        });
    </script>
</body>
</html>
