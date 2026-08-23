@props([
    'program',
])

@php
    $days = \App\Support\ProgramListing::days($program);
    $minutes = \App\Support\ProgramListing::minutesLabel($program);
@endphp

<p {{ $attributes->class('program-portrait__meta') }}>
    <span class="program-meta-chip">
        <svg class="ui-icon ui-icon--meta-cal" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" aria-hidden="true"><rect x="3" y="5" width="18" height="16" rx="2"/><path d="M3 10h18M8 3v4M16 3v4"/></svg>
        {{ $days }} days
    </span>
    <span class="program-meta-chip">
        <svg class="ui-icon ui-icon--meta-clock" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" aria-hidden="true"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg>
        {{ $minutes }}
    </span>
</p>
