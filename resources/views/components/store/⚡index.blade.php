<?php

use App\Models\Product;
use Livewire\Attributes\Url;
use Livewire\Component;

new class extends Component
{
    #[Url]
    public string $category = 'All';

    public function with(): array
    {
        $items = Product::query()->published()->orderBy('sort')->get();

        if ($this->category !== 'All') {
            $items = $items->where('category', $this->category);
        }

        return [
            'products' => $items->values(),
            'categories' => ['All', 'Apparel', 'Accessories', 'Equipment'],
        ];
    }
};
?>

<div>
    <div class="mb-8 flex flex-wrap gap-2">
        @foreach ($categories as $category)
            <button
                type="button"
                wire:click="$set('category', '{{ $category }}')"
                class="filter-chip {{ $category === $this->category ? 'filter-chip-active' : '' }}"
            >{{ $category }}</button>
        @endforeach
    </div>

    <div class="grid gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
        @forelse ($products as $item)
            <a href="{{ route('store.show', $item['slug']) }}" class="group block cursor-pointer overflow-hidden">
                <img
                    src="{{ \App\Support\Media::url($item['image'] ?? null) }}"
                    alt="{{ \App\Support\Media::alt($item['title'] ?? null, 'Product') }}"
                    class="store-list-card__img"
                    loading="lazy"
                >
                <div class="mt-3">
                    <h3 class="font-display text-sm font-semibold text-ink group-hover:underline">{{ $item['title'] }}</h3>
                    <p class="mt-0.5 text-xs text-muted">${{ number_format($item['price'], 0) }}</p>
                </div>
            </a>
        @empty
            <div class="sm:col-span-2 md:col-span-3 lg:col-span-4">
                <x-empty-state
                    message="No products in this category."
                    hint="Browse Apparel or publish new items in the admin CMS. Checkout is not available in this catalog."
                />
            </div>
        @endforelse
    </div>
</div>
