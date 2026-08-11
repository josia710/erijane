@php
    $features = $features ?? \App\Support\SiteContent::communityFeatures();
    $communityHero = \App\Support\SiteContent::section('community', 'hero');
    $workoutTiles = [
        ['label' => 'Tiny Waist Round Butt', 'tone' => 'lavender'],
        ['label' => 'Warm Up Routine', 'tone' => 'peach'],
        ['label' => 'Toned Arms', 'tone' => 'sky'],
        ['label' => 'Best Full Body Burn', 'tone' => 'mint'],
    ];
@endphp

<section class="site-container py-16">
    <div class="overflow-hidden rounded-[2rem] bg-gradient-to-br from-sky-50 via-white to-rose-50 p-8 sm:p-12">
        <div class="grid items-center gap-10 lg:grid-cols-2">
            <div>
                <span class="inline-block rounded bg-mint px-2 py-0.5 text-[10px] font-bold uppercase tracking-wide text-teal-800">Absolutely Free</span>
                <h2 class="mt-4 font-display text-3xl font-semibold tracking-tight text-ink sm:text-4xl">{{ $communityHero?->title ?? 'Get more out of your fitness journey' }}</h2>
                <p class="mt-2 text-base font-medium text-ink/70">{{ $communityHero?->body ?? 'Join the community to track your progress' }}</p>
                <ul class="mt-6 space-y-3">
                    @foreach ($features as $feature)
                        <li class="flex items-start gap-3">
                            <span class="mt-0.5 flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-mint text-teal-800">
                                <svg class="h-3 w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                            </span>
                            <span class="text-sm text-ink">{{ is_array($feature) ? ($feature['title'] ?? '') : ($feature->title ?? '') }}</span>
                        </li>
                    @endforeach
                </ul>
                <a href="{{ route('signup') }}" class="btn-pill mt-8">Create Account</a>
            </div>
            <div class="mx-auto w-full max-w-sm">
                <div class="rounded-3xl bg-white p-5 shadow-xl ring-1 ring-black/5">
                    <div class="flex items-center justify-between">
                        <span class="font-display text-sm font-semibold text-ink">Today's workout</span>
                        <span class="rounded-full bg-mint px-3 py-1 text-[11px] font-semibold text-teal-800">Mark as complete</span>
                    </div>
                    <div class="mt-4 grid grid-cols-2 gap-3">
                        @foreach ($workoutTiles as $tile)
                            <div class="flex h-24 items-end rounded-2xl card-tone-{{ $tile['tone'] }} p-3">
                                <span class="font-display text-xs font-semibold leading-tight text-ink">{{ $tile['label'] }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
