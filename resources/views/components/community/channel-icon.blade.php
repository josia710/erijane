@props(['name'])

@php
    $class = 'h-4 w-4 shrink-0';
@endphp

@switch ($name)
    @case ('fitness')
        <svg class="{{ $class }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" d="M4 9v6M7 8v8M17 8v8M20 9v6M7 12h10"/></svg>
        @break
    @case ('sparkles')
        <svg class="{{ $class }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M12 3l1.2 4.2L17 8.5l-3.8 1.3L12 14l-1.2-4.2L7 8.5l3.8-1.3L12 3zM18 14l.7 2.3 2.3.7-2.3.7L18 20l-.7-2.3L15 17l2.3-.7L18 14z"/></svg>
        @break
    @case ('globe')
        <svg class="{{ $class }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><circle cx="12" cy="12" r="8"/><path d="M4 12h16M12 4c2.5 2.8 3.8 5.6 3.8 8S14.5 17.2 12 20c-2.5-2.8-3.8-5.6-3.8-8S9.5 6.8 12 4z"/></svg>
        @break
    @case ('food')
        <svg class="{{ $class }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M8 4v8M6 4v4m4-4v4M7 12v8M16 5v15M16 5c2 0 3 1.5 3 4s-1 4-3 4"/></svg>
        @break
    @case ('chat')
        <svg class="{{ $class }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M5 6h14v10H8l-3 3V6z"/></svg>
        @break
    @case ('bulb')
        <svg class="{{ $class }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M9 18h6M10 21h4M12 3a6 6 0 00-3 11c.4.5.8 1.2.9 2h4.2c.1-.8.5-1.5.9-2A6 6 0 0012 3z"/></svg>
        @break
    @case ('wrench')
        <svg class="{{ $class }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M14 7a4 4 0 105.6 5.6L14 13l-6.5 6.5-1.8-1.8L12 11l.4-4.6z"/></svg>
        @break
    @case ('users')
        <svg class="{{ $class }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><circle cx="9" cy="8" r="3"/><circle cx="17" cy="9" r="2.5"/><path d="M4 19c.5-3 2.5-5 5-5s4.5 2 5 5M14 19c.3-2 1.6-3.5 3.5-3.5 1.5 0 2.7 1 3.2 2.5"/></svg>
        @break
    @case ('megaphone')
        <svg class="{{ $class }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M4 10v4l2 .5 9 4V5.5L6 9.5 4 10zM15 9.5c1.2.6 2 1.6 2 2.5s-.8 1.9-2 2.5M7 14.5V18"/></svg>
        @break
    @default
        <svg class="{{ $class }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><circle cx="12" cy="12" r="8"/></svg>
@endswitch
