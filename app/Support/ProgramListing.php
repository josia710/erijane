<?php

namespace App\Support;

use App\Models\Program;
use Illuminate\Support\Collection;

final class ProgramListing
{
    /**
     * @return array<string, array{title: string, blurb: ?string, featured: bool}>
     */
    public static function collections(): array
    {
        return [
            'latest' => [
                'title' => 'Latest Challenges',
                'blurb' => null,
                'featured' => true,
            ],
            'popular' => [
                'title' => 'Most Popular',
                'blurb' => null,
                'featured' => false,
            ],
            'beginner' => [
                'title' => 'Beginner Friendly',
                'blurb' => 'Looking to get started on your fitness journey? Try one of these beginner-friendly programs! These have shorter time commitments or have low-impact alternatives.',
                'featured' => false,
            ],
            'advanced' => [
                'title' => 'Moderate to Advanced',
                'blurb' => 'If you\'re looking for something that pushes you a little harder, try any of these moderate to advanced challenges to help you progress further.',
                'featured' => false,
            ],
            'weight-loss' => [
                'title' => 'Weight Loss',
                'blurb' => 'Get started on your weight loss journey with one of these challenges that are high intensity and will get you sweating!',
                'featured' => false,
            ],
            'abs' => [
                'title' => 'Abs',
                'blurb' => 'Your abs will love you and hate you at the same time! Try out any one of these core focused workout programs.',
                'featured' => false,
            ],
            'booty-legs' => [
                'title' => 'Booty and Legs',
                'blurb' => 'If you\'re looking to work your lower body or grow your glutes, try out these leg and booty programs without equipment or with dumbbells and resistance bands.',
                'featured' => false,
            ],
            'strength' => [
                'title' => 'Strength Training',
                'blurb' => 'If you\'re looking to work on your strength, check out these resistance based programs. We\'d recommend having resistance bands and a variety of dumbbells.',
                'featured' => false,
            ],
            'no-equipment' => [
                'title' => 'No Equipment',
                'blurb' => 'These programs can be done at home without the need for equipment like dumbbells or resistance bands!',
                'featured' => false,
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

    public static function days(Program $program): int
    {
        return max(1, (int) $program->weeks) * 7;
    }

    public static function minutesLabel(Program $program): string
    {
        return match ($program->level) {
            'Beginner' => '20-40 min/day',
            'Advanced' => '35-60 min/day',
            default => '30-40 min/day',
        };
    }

    /**
     * @return list<string>
     */
    public static function focusAreas(Program $program): array
    {
        return match ($program->focus) {
            'Core' => ['Abs & Core'],
            'Lower Body' => ['Booty', 'Legs'],
            'HIIT' => ['Weight Loss'],
            'Tone' => ['Resistance'],
            'Full Body' => ['Full Body'],
            default => [$program->focus],
        };
    }

    /**
     * @return list<string>
     */
    public static function equipment(Program $program): array
    {
        return match ($program->focus) {
            'Tone' => ['Fitness Mat', 'Dumbbells'],
            'Lower Body' => ['Fitness Mat', 'Resistance Bands'],
            default => ['Fitness Mat'],
        };
    }

    public static function inCollection(Program $program, string $key): bool
    {
        $areas = self::focusAreas($program);

        return match ($key) {
            'latest' => true,
            'popular' => $program->sort > 0,
            'beginner' => $program->level === 'Beginner',
            'advanced' => in_array($program->level, ['Intermediate', 'Advanced'], true),
            'weight-loss' => in_array('Weight Loss', $areas, true) || $program->focus === 'Full Body',
            'abs' => in_array('Abs & Core', $areas, true),
            'booty-legs' => in_array('Legs', $areas, true) || in_array('Booty', $areas, true),
            'strength' => in_array('Resistance', $areas, true) || $program->focus === 'Full Body',
            'no-equipment' => ! in_array('Dumbbells', self::equipment($program), true),
            default => true,
        };
    }

    /**
     * @param  list<string>  $focus
     * @param  list<string>  $duration
     * @param  list<string>  $equipment
     * @param  list<string>  $year
     */
    public static function matchesFilters(Program $program, array $focus, array $duration, array $equipment, array $year): bool
    {
        if ($focus !== [] && array_intersect($focus, self::focusAreas($program)) === []) {
            return false;
        }

        if ($duration !== []) {
            $days = self::days($program);
            $bucket = match (true) {
                $days <= 14 => '1 - 14 days',
                $days <= 21 => '15 - 21 days',
                $days <= 28 => '22 - 28 days',
                default => '29 days +',
            };
            if (! in_array($bucket, $duration, true)) {
                return false;
            }
        }

        if ($equipment !== [] && array_intersect($equipment, self::equipment($program)) === []) {
            return false;
        }

        if ($year !== []) {
            $programYear = (string) ($program->published_at?->year ?? '');
            if (! in_array($programYear, $year, true)) {
                return false;
            }
        }

        return true;
    }

    /**
     * @param  Collection<int, Program>  $items
     * @return Collection<int, Program>
     */
    public static function forCollection(Collection $items, string $key): Collection
    {
        return $items->filter(fn (Program $program) => self::inCollection($program, $key))->values();
    }
}
