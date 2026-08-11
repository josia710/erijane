<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Program;
use App\Models\Recipe;
use App\Models\Video;
use Illuminate\Database\Seeder;

class CatalogSeeder extends Seeder
{
    public function run(): void
    {
        $catalog = require database_path('data/catalog.php');
        $now = now();

        foreach ($catalog['programs'] ?? [] as $i => $row) {
            Program::query()->updateOrCreate(
                ['slug' => $row['slug']],
                [
                    'title' => $row['title'],
                    'badge' => $row['badge'] ?? null,
                    'tone' => $row['tone'] ?? 'mint',
                    'weeks' => $row['weeks'] ?? 1,
                    'level' => $row['level'] ?? 'Beginner',
                    'focus' => $row['focus'] ?? 'Full Body',
                    'image' => $row['image'] ?? null,
                    'sort' => $i,
                    'published_at' => $now,
                ]
            );
        }

        foreach ($catalog['videos'] ?? [] as $i => $row) {
            Video::query()->updateOrCreate(
                ['slug' => $row['slug']],
                [
                    'title' => $row['title'],
                    'date_label' => $row['date'] ?? null,
                    'duration' => $row['duration'] ?? null,
                    'category' => $row['category'] ?? null,
                    'image' => $row['image'] ?? null,
                    'sort' => $i,
                    'published_at' => $now,
                ]
            );
        }

        foreach ($catalog['recipes'] ?? [] as $i => $row) {
            Recipe::query()->updateOrCreate(
                ['slug' => $row['slug']],
                [
                    'title' => $row['title'],
                    'category' => $row['category'] ?? null,
                    'time' => $row['time'] ?? null,
                    'tone' => $row['tone'] ?? 'peach',
                    'image' => $row['image'] ?? null,
                    'sort' => $i,
                    'published_at' => $now,
                ]
            );
        }

        foreach ($catalog['store'] ?? [] as $i => $row) {
            Product::query()->updateOrCreate(
                ['slug' => $row['slug']],
                [
                    'title' => $row['title'],
                    'price' => $row['price'] ?? 0,
                    'category' => $row['category'] ?? 'Apparel',
                    'tone' => $row['tone'] ?? 'sky',
                    'image' => $row['image'] ?? null,
                    'line' => $row['line'] ?? null,
                    'sort' => $i,
                    'published_at' => $now,
                ]
            );
        }
    }
}
