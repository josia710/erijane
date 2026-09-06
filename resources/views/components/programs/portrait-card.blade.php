@props([
    'program',
])

<a href="{{ route('programs.show', $program['slug']) }}" class="program-portrait group">
    <div class="program-portrait__media card-tone-{{ $program['tone'] }}">
        @if ($program['badge'])
            <span class="program-new">{{ $program['badge'] }}</span>
        @endif
        @if (in_array($program['slug'], session()->get('completed_programs', []), true))
            <span class="absolute right-2 top-2 z-10 inline-flex h-6 w-6 items-center justify-center rounded-full bg-brand text-xs font-bold text-white" title="Completed">✓</span>
        @endif
        <img
            src="{{ \App\Support\Media::url($program['image'] ?? null) }}"
            alt="{{ \App\Support\Media::alt($program['title'] ?? null, 'Program') }}"
            class="program-portrait__img"
            loading="lazy"
        >
        <span class="program-portrait__cta">View Challenge</span>
    </div>
    <x-programs.meta-chips :program="$program" />
    <h3 class="program-portrait__title">{{ $program['title'] }}</h3>
</a>
