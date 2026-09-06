<?php

namespace Database\Seeders;

use App\Models\VideoCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class VideoCategorySeeder extends Seeder
{
    public function run(): void
    {
        foreach (['Abs', 'Full Body', 'Pilates', 'Cardio', 'Lower Body', 'Upper Body', 'Recovery'] as $i => $name) {
            VideoCategory::query()->updateOrCreate(
                ['slug' => Str::slug($name)],
                ['name' => $name, 'sort' => $i],
            );
        }
    }
}
