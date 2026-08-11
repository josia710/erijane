@php
    $socials = \App\Support\SiteContent::socials();
@endphp

<footer class="mt-16 border-t border-border bg-white">
    <div class="site-container py-10">
        <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-[1fr_auto_auto] lg:items-start lg:gap-12">
            <h6 class="text-sm font-semibold text-ink">© {{ date('Y') }} Erijane</h6>

            <div>
                <h6 class="mb-3 text-sm font-semibold text-ink">Support</h6>
                <ul class="space-y-2 text-sm text-muted">
                    <li><a href="{{ route('about') }}" class="transition hover:text-ink">Privacy Policy</a></li>
                    <li><a href="{{ route('about') }}" class="transition hover:text-ink">Terms &amp; Conditions</a></li>
                    <li><a href="{{ route('about') }}" class="transition hover:text-ink">FAQs</a></li>
                    <li><a href="{{ route('about') }}" class="transition hover:text-ink">About</a></li>
                </ul>
            </div>

            <div>
                <h6 class="mb-3 text-sm font-semibold text-ink">Socials</h6>
                <ul class="flex flex-wrap gap-3">
                    @foreach ($socials as $social)
                        <li>
                            <a
                                href="{{ $social['href'] }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="inline-flex h-9 w-9 items-center justify-center rounded-full border border-gray-200 text-ink transition hover:border-ink hover:bg-surface"
                                aria-label="{{ $social['label'] }}"
                            >
                                @include('partials.icons.'.$social['icon'])
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <p class="mt-8 text-xs text-muted">
            Local Laravel + Livewire recreation for study. Not affiliated with the official Chloe Ting brand.
        </p>
    </div>
</footer>
