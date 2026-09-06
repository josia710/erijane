<?php

namespace App\Support;

use App\Models\Recipe;
use Illuminate\Support\Collection;

final class RecipeListing
{
    /**
     * @return array<string, array{title: string, blurb: ?string, index: bool}>
     */
    public static function collections(): array
    {
        return [
            'latest' => [
                'title' => 'Latest Recipes',
                'blurb' => null,
                'index' => true,
            ],
            'featured' => [
                'title' => 'Featured Recipes',
                'blurb' => 'Here is a list of the most popular recipes that people are loving! Try out some of these recipes to find out why everyone is raving about them.',
                'index' => true,
            ],
            'berry' => [
                'title' => 'Berry Delicious',
                'blurb' => 'Dreaming of summer-sweet berries? This recipe collection can inspire you all year round!',
                'index' => true,
            ],
            'vegan' => [
                'title' => 'Easy Vegan Recipes',
                'blurb' => 'A collection of simple, delicious recipes free from dairy, meat or eggs.',
                'index' => true,
            ],
            'dessert' => [
                'title' => 'Healthy Dessert Recipes',
                'blurb' => 'Love dessert while on a fitness journey? These healthy yet delicious sweet treats will satisfy that sweet tooth while keeping you on track.',
                'index' => true,
            ],
            'quick' => [
                'title' => 'Quick And Easy Recipes',
                'blurb' => 'Recipes that require only one pan and less than 30 minutes to make. Perfect for lazy days!',
                'index' => true,
            ],
            'snacks' => [
                'title' => 'Healthy Snack Ideas',
                'blurb' => 'Easy healthy snacks full of protein, fiber, and healthy fats to keep you fueled up throughout the day.',
                'index' => true,
            ],
            'high-protein' => [
                'title' => 'The Best High Protein Recipes',
                'blurb' => 'Discover the best high protein meal ideas that are as easy to make as they are delicious!',
                'index' => true,
            ],
            'breakfast' => [
                'title' => 'Easy Breakfast Ideas',
                'blurb' => 'Start your day right with these easy peasy ideas. Some can even be prepared ahead of time!',
                'index' => true,
            ],
            'drinks' => [
                'title' => 'Healthy Drinks Recipes',
                'blurb' => 'From smoothies to matcha latte or homemade boba, here are some healthy drinks to quench that thirst!',
                'index' => true,
            ],
            'party' => [
                'title' => 'Party Food Recipes',
                'blurb' => 'Here are some of the best finger food and bite-sized appetizers to serve at your next party or picnic.',
                'index' => true,
            ],
            'pancakes' => [
                'title' => 'Healthy Pancakes Recipes',
                'blurb' => 'The best healthy pancakes recipes that still taste like a treat! Pick from gluten-free, high protein, vegan, and more.',
                'index' => true,
            ],
            'low-carb' => [
                'title' => 'Low Carb',
                'blurb' => null,
                'index' => false,
            ],
            'dairy-free' => [
                'title' => 'Dairy Free',
                'blurb' => null,
                'index' => false,
            ],
            'vegetarian' => [
                'title' => 'Vegetarian',
                'blurb' => null,
                'index' => false,
            ],
        ];
    }

    /**
     * @return array<string, string>
     */
    public static function browseOptions(): array
    {
        $options = ['all' => 'View All Collections'];

        foreach (self::collections() as $key => $row) {
            if (! $row['index']) {
                continue;
            }
            $options[$key] = $row['title'];
        }

        return $options;
    }

    /**
     * @return list<array{key: string, title: string, category: string}>
     */
    public static function popularCategories(): array
    {
        return [
            ['key' => 'high-protein', 'title' => 'High Protein', 'category' => 'High Protein'],
            ['key' => 'low-carb', 'title' => 'Low Carb', 'category' => 'Low Carb'],
            ['key' => 'dairy-free', 'title' => 'Dairy Free', 'category' => 'Dairy Free'],
            ['key' => 'vegetarian', 'title' => 'Vegetarian', 'category' => 'Vegetarian'],
        ];
    }

    public static function minutes(Recipe $recipe): int
    {
        if (preg_match('/(\d+)/', (string) $recipe->time, $match) !== 1) {
            return 0;
        }

        return (int) $match[1];
    }

    /**
     * @return list<array{code: string, label: string, key: string}>
     */
    public static function dietTags(Recipe $recipe): array
    {
        $title = mb_strtolower((string) $recipe->title);
        $tags = [];

        foreach ([
            'High Protein' => ['HP', 'High Protein', 'high-protein'],
            'Low Carb' => ['LC', 'Low Carb', 'low-carb'],
            'Dairy Free' => ['DF', 'Dairy Free', 'dairy-free'],
            'Vegetarian' => ['Vg', 'Vegetarian', 'vegetarian'],
        ] as $category => [$code, $label, $key]) {
            if ($recipe->category === $category) {
                $tags[] = ['code' => $code, 'label' => $label, 'key' => $key];
            }
        }

        if (str_contains($title, 'vegan')) {
            $tags[] = ['code' => 'Vn', 'label' => 'Vegan', 'key' => 'vegan'];
        }

        $seen = [];
        $unique = [];
        foreach ($tags as $tag) {
            if (isset($seen[$tag['code']])) {
                continue;
            }
            $seen[$tag['code']] = true;
            $unique[] = $tag;
        }

        return $unique;
    }

    public static function inCollection(Recipe $recipe, string $key): bool
    {
        $title = mb_strtolower((string) $recipe->title);
        $category = (string) $recipe->category;
        $minutes = self::minutes($recipe);

        return match ($key) {
            'latest', 'featured' => true,
            'berry' => str_contains($title, 'berry') || str_contains($title, 'strawberry'),
            'vegan' => $category === 'Dairy Free' || str_contains($title, 'vegan'),
            'dessert' => str_contains($title, 'pancake') || str_contains($title, 'oats') || str_contains($title, 'chocolate'),
            'quick' => $minutes > 0 && $minutes <= 30,
            'snacks' => str_contains($title, 'wrap') || str_contains($title, 'salad') || str_contains($title, 'gimbap'),
            'high-protein' => $category === 'High Protein',
            'breakfast' => str_contains($title, 'oats') || str_contains($title, 'pancake') || str_contains($title, 'latte'),
            'drinks' => str_contains($title, 'smoothie') || str_contains($title, 'latte'),
            'party' => str_contains($title, 'gimbap') || str_contains($title, 'burger'),
            'pancakes' => str_contains($title, 'pancake'),
            'low-carb' => $category === 'Low Carb',
            'dairy-free' => $category === 'Dairy Free',
            'vegetarian' => $category === 'Vegetarian',
            default => true,
        };
    }

    /**
     * @param  list<string>  $course
     * @param  list<string>  $convenience
     * @param  list<string>  $preference
     * @param  list<string>  $dietary
     * @param  list<string>  $time
     */
    public static function matchesFilters(Recipe $recipe, array $course, array $convenience, array $preference, array $dietary, array $time): bool
    {
        if ($course !== [] || $convenience !== []) {
            return false;
        }

        if ($preference !== []) {
            $prefs = [];
            if ($recipe->category === 'High Protein') {
                $prefs[] = 'High Protein';
            }
            if ($recipe->category === 'Low Carb') {
                $prefs[] = 'Low Carb';
            }
            if (array_intersect($preference, $prefs) === []) {
                return false;
            }
        }

        if ($dietary !== []) {
            $flags = [];
            if ($recipe->category === 'Dairy Free') {
                $flags[] = 'Dairy Free';
            }
            if ($recipe->category === 'Vegetarian') {
                $flags[] = 'Vegetarian';
            }
            if ($recipe->category === 'Dairy Free' || str_contains(mb_strtolower((string) $recipe->title), 'vegan')) {
                $flags[] = 'Vegan';
            }
            if (array_intersect($dietary, $flags) === []) {
                return false;
            }
        }

        if ($time !== []) {
            $minutes = self::minutes($recipe);
            $buckets = [];
            if ($minutes > 0 && $minutes <= 10) {
                $buckets[] = '10 Mins or Less';
            }
            if ($minutes > 0 && $minutes <= 30) {
                $buckets[] = '30 Mins or Less';
            }
            if ($minutes >= 30) {
                $buckets[] = '30 Mins +';
            }
            if (array_intersect($time, $buckets) === []) {
                return false;
            }
        }

        return true;
    }

    /**
     * @param  Collection<int, Recipe>  $items
     * @return Collection<int, Recipe>
     */
    public static function forCollection(Collection $items, string $key): Collection
    {
        return $items->filter(fn (Recipe $recipe) => self::inCollection($recipe, $key))->values();
    }
}
