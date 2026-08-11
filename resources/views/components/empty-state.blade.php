@props([
    'message' => 'Nothing to show yet.',
    'hint' => null,
])

<div class="rounded-2xl bg-surface px-6 py-10 text-center ring-1 ring-border" role="status">
    <p class="font-display text-sm font-semibold text-ink">{{ $message }}</p>
    @if ($hint)
        <p class="mt-2 text-sm text-muted">{{ $hint }}</p>
    @endif
</div>
