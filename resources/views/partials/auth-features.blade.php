@php
    $authFeatures = $authFeatures ?? [
        [
            'tone' => 'sky',
            'title' => "Today's Workout Completed!",
            'body' => 'Track your daily workouts and your progress on your fitness journey.',
            'image' => 'images/chloe/hero/train.ff560bfb.png',
        ],
        [
            'tone' => 'mint',
            'title' => 'Teamwork Makes the Dream Work',
            'body' => 'Join a team challenge to motivate one another and work out together.',
            'image' => 'images/chloe/hero/connect.44ddc83d.png',
        ],
        [
            'tone' => 'lavender',
            'title' => 'Picture Perfect!',
            'body' => 'Add photos and create collages to see your progress visually.',
            'image' => 'images/chloe/hero/monitor.d3c8005f.png',
        ],
        [
            'tone' => 'peach',
            'title' => 'Meal Planning Pro',
            'body' => 'Save and organize all of your favorite recipes.',
            'image' => 'images/chloe/hero/organize.039755f5.png',
        ],
    ];
@endphp

<aside class="auth-shell__aside" aria-label="Account features">
    <h2 class="text-center font-display text-lg font-semibold text-ink">Create an account to access features such as</h2>
    <div class="mt-6 space-y-4">
        @foreach ($authFeatures as $feature)
            <div class="auth-feature card-tone-{{ $feature['tone'] }}">
                <div class="auth-feature__copy">
                    <p class="font-display text-sm font-semibold text-ink">{{ $feature['title'] }}</p>
                    <p class="mt-1 text-xs leading-relaxed text-ink/70">{{ $feature['body'] }}</p>
                </div>
                <img src="{{ asset($feature['image']) }}" alt="" class="auth-feature__img" loading="lazy">
            </div>
        @endforeach
    </div>
</aside>
