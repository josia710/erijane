@extends('layouts.app')

@section('title', $product['title'].' - Store - Erijane')

@section('content')
<div class="site-container py-12">
    <a href="{{ route('store') }}" class="text-sm text-muted transition hover:text-ink">← Merch</a>
    <div class="mt-6 grid gap-8 lg:grid-cols-2 lg:items-start">
        <img
            src="{{ \App\Support\Media::url($product['image'] ?? null) }}"
            alt="{{ \App\Support\Media::alt($product['title'] ?? null, 'Product') }}"
            class="store-list-card__img w-full max-w-md"
        >
        <div>
            <p class="text-sm uppercase tracking-wide text-muted">{{ $product['category'] }}</p>
            <h1 class="mt-2 font-display text-3xl font-semibold tracking-tight text-ink">{{ $product['title'] }}</h1>
            <p class="mt-3 text-2xl font-semibold text-ink">${{ number_format($product['price'], 0) }}</p>
            <p class="mt-2 text-sm text-muted">Catalog preview only — payments and shipping are not enabled.</p>

            <div class="bag-panel mt-8">
                <div class="flex flex-wrap items-center gap-3">
                    <label class="text-sm font-medium text-ink" for="size">Size</label>
                    <select id="size" class="rounded-full border border-gray-200 px-4 py-2 text-sm">
                        <option>XS</option>
                        <option selected>S</option>
                        <option>M</option>
                        <option>L</option>
                        <option>XL</option>
                    </select>
                    <label class="text-sm font-medium text-ink" for="qty">Qty</label>
                    <input id="qty" type="number" min="1" value="1" class="w-16 rounded-full border border-gray-200 px-3 py-2 text-sm">
                </div>
                <button type="button" id="add-to-bag" class="btn-pill mt-6 w-full sm:w-auto">Add to bag</button>
                <p id="bag-status" class="mt-3 hidden text-sm text-muted" role="status"></p>
                <p class="mt-4 text-xs text-muted">Bag UI only. No payment processor, cart sync, or checkout.</p>
            </div>

            <div class="mt-6 divide-y divide-border rounded-2xl border border-border">
                <details class="group px-5 py-4">
                    <summary class="flex cursor-pointer list-none items-center justify-between text-sm font-semibold text-ink">Details <span class="text-muted transition group-open:rotate-180">▾</span></summary>
                    <p class="mt-2 text-sm text-muted">{{ $product['category'] }} · Erijane studio catalog. Model imagery is illustrative.</p>
                </details>
                <details class="group px-5 py-4">
                    <summary class="flex cursor-pointer list-none items-center justify-between text-sm font-semibold text-ink">Shipping &amp; Returns <span class="text-muted transition group-open:rotate-180">▾</span></summary>
                    <p class="mt-2 text-sm text-muted">Catalog preview only — no shipping, returns, or checkout are enabled.</p>
                </details>
            </div>
        </div>
    </div>

    @php
        $relatedProducts = \App\Models\Product::query()
            ->published()
            ->where('id', '!=', $product['id'])
            ->when($product['category'], fn ($q) => $q->where('category', $product['category']))
            ->orderBy('sort')
            ->take(4)
            ->get();
        if ($relatedProducts->count() < 4) {
            $relatedProducts = \App\Models\Product::query()
                ->published()
                ->where('id', '!=', $product['id'])
                ->orderBy('sort')
                ->take(4)
                ->get();
        }
    @endphp
    @if ($relatedProducts->isNotEmpty())
        <section class="mt-16">
            <div class="programs-row-head">
                <h2 class="programs-h2">You May Also Like</h2>
                <a href="{{ route('store') }}" class="programs-view-all max-lg:hidden">Visit Store</a>
                <a href="{{ route('store') }}" class="programs-view-all-link lg:hidden">Visit Store</a>
            </div>
            <div class="grid gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                @foreach ($relatedProducts as $rel)
                    <a href="{{ route('store.show', $rel['slug']) }}" class="group block cursor-pointer overflow-hidden">
                        <img
                            src="{{ \App\Support\Media::url($rel['image'] ?? null) }}"
                            alt="{{ \App\Support\Media::alt($rel['title'] ?? null, 'Product') }}"
                            class="store-list-card__img"
                            loading="lazy"
                        >
                        <div class="mt-3">
                            <h3 class="font-display text-sm font-semibold text-ink group-hover:underline">{{ $rel['title'] }}</h3>
                            <p class="mt-0.5 text-xs text-muted">${{ number_format($rel['price'], 0) }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>
    @endif
</div>
<script>
    document.getElementById('add-to-bag')?.addEventListener('click', () => {
        const status = document.getElementById('bag-status');
        if (!status) return;
        status.textContent = 'Saved to bag shell — checkout is not connected on this catalog site.';
        status.classList.remove('hidden');
    });
</script>
@endsection
