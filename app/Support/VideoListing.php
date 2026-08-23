<?php

namespace App\Support;

use App\Models\Video;
use Illuminate\Support\Collection;

final class VideoListing
{
    /**
     * @return array<string, array{title: string, blurb: ?string, index: bool}>
     */
    public static function collections(): array
    {
        return [
            'latest' => [
                'title' => 'Latest Workouts',
                'blurb' => null,
                'index' => true,
            ],
            'popular' => [
                'title' => 'Most Popular',
                'blurb' => 'These are some of the most popular workout videos. Give them a try and see why people love these routines.',
                'index' => true,
            ],
            'hiit' => [
                'title' => 'HIIT',
                'blurb' => 'Ready to get your heart pumping? These HIIT & cardio workouts will help you burn those calories!',
                'index' => true,
            ],
            'abs' => [
                'title' => 'Abs',
                'blurb' => 'If you\'re looking to work on that 6 pack, check out these ab and core workout routines!',
                'index' => true,
            ],
            'booty' => [
                'title' => 'Booty',
                'blurb' => 'Want to grow a booty? There are equipment and non-equipment workouts to help you grow your glutes.',
                'index' => true,
            ],
            'dumbbell' => [
                'title' => 'Dumbbell',
                'blurb' => 'Check out these dumbbell workouts that you can do at home to build strength and get toned.',
                'index' => true,
            ],
            '10-mins' => [
                'title' => '10 Mins',
                'blurb' => 'Want a quick workout? These videos are only 10 minutes long to help you get a quick and effective workout in.',
                'index' => true,
            ],
            '20-mins' => [
                'title' => '20 Mins+',
                'blurb' => 'If you prefer longer workouts, check out these 20+ minutes workouts.',
                'index' => true,
            ],
            'standing' => [
                'title' => 'Standing Workouts',
                'blurb' => null,
                'index' => false,
            ],
            'no-jumping' => [
                'title' => 'No Jumping',
                'blurb' => null,
                'index' => false,
            ],
            'no-planks' => [
                'title' => 'No Planks',
                'blurb' => null,
                'index' => false,
            ],
            'burpee-free' => [
                'title' => 'Burpee Free',
                'blurb' => null,
                'index' => false,
            ],
            'wrist-friendly' => [
                'title' => 'Wrist Friendly',
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
            $options[$key] = $row['title'];
        }

        return $options;
    }

    public static function minutes(Video $video): int
    {
        if (preg_match('/(\d+)/', (string) $video->duration, $match) !== 1) {
            return 0;
        }

        return (int) $match[1];
    }

    public static function clockLabel(Video $video): string
    {
        $raw = (string) $video->duration;
        if (str_contains($raw, ':')) {
            return $raw;
        }

        return sprintf('%d:%02d', self::minutes($video), 0);
    }

    /**
     * @return list<string>
     */
    public static function focusAreas(Video $video): array
    {
        return match ($video->category) {
            'Abs', 'Pilates' => ['Abs'],
            'Lower Body' => ['Booty', 'Legs', 'Lower Body'],
            'Full Body', 'Cardio', 'Recovery' => ['Full Body'],
            default => array_filter([(string) $video->category]),
        };
    }

    /**
     * @return list<string>
     */
    public static function workoutTypes(Video $video): array
    {
        $types = [];
        $category = (string) $video->category;
        $title = (string) $video->title;

        if (in_array($category, ['Abs', 'Full Body', 'Pilates', 'Cardio', 'Recovery'], true)) {
            $types[] = 'Body Weight Workouts';
        }
        if ($category === 'Cardio' || str_contains($title, 'HIIT')) {
            $types[] = 'HIIT & Cardio';
        }
        if ($category === 'Lower Body') {
            $types[] = 'Weighted Workouts';
        }
        if ($category === 'Recovery') {
            $types[] = 'Cooldown';
        }

        return array_values(array_unique($types));
    }

    /**
     * @return list<string>
     */
    public static function equipment(Video $video): array
    {
        return $video->category === 'Lower Body' ? ['Dumbbells'] : [];
    }

    /**
     * @return list<string>
     */
    public static function tags(Video $video): array
    {
        $tags = array_map(strtoupper(...), self::workoutTypes($video));
        foreach (self::focusAreas($video) as $area) {
            $tags[] = strtoupper($area);
        }

        return array_values(array_unique($tags));
    }

    public static function durationBucket(Video $video): string
    {
        $minutes = self::minutes($video);

        return match (true) {
            $minutes <= 10 => '5-10 Min',
            $minutes <= 15 => '10-15 Min',
            $minutes <= 20 => '15-20 Min',
            default => '20 Min +',
        };
    }

    public static function inCollection(Video $video, string $key): bool
    {
        $minutes = self::minutes($video);
        $title = (string) $video->title;
        $category = (string) $video->category;

        return match ($key) {
            'latest' => true,
            'popular' => $video->sort > 0,
            'hiit' => $category === 'Cardio' || str_contains($title, 'HIIT'),
            'abs' => in_array($category, ['Abs', 'Pilates'], true),
            'booty' => $category === 'Lower Body',
            'dumbbell' => $category === 'Lower Body',
            '10-mins' => $minutes > 0 && $minutes <= 12,
            '20-mins' => $minutes >= 20,
            'standing', 'no-jumping', 'no-planks', 'burpee-free', 'wrist-friendly' => false,
            default => true,
        };
    }

    /**
     * @param  list<string>  $focus
     * @param  list<string>  $type
     * @param  list<string>  $preference
     * @param  list<string>  $duration
     * @param  list<string>  $equipment
     */
    public static function matchesFilters(Video $video, array $focus, array $type, array $preference, array $duration, array $equipment): bool
    {
        if ($preference !== []) {
            return false;
        }

        if ($focus !== [] && array_intersect($focus, self::focusAreas($video)) === []) {
            return false;
        }

        if ($type !== [] && array_intersect($type, self::workoutTypes($video)) === []) {
            return false;
        }

        if ($duration !== [] && ! in_array(self::durationBucket($video), $duration, true)) {
            return false;
        }

        if ($equipment !== [] && array_intersect($equipment, self::equipment($video)) === []) {
            return false;
        }

        return true;
    }

    /**
     * @param  Collection<int, Video>  $items
     * @return Collection<int, Video>
     */
    public static function forCollection(Collection $items, string $key): Collection
    {
        return $items->filter(fn (Video $video) => self::inCollection($video, $key))->values();
    }
}
