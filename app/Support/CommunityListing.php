<?php

namespace App\Support;

use Illuminate\Support\Collection;

final class CommunityListing
{
    public const PER_PAGE = 6;

    /**
     * @return list<array{slug: string, label: string, icon: string}>
     */
    public static function channels(): array
    {
        return [
            ['slug' => 'fitness', 'label' => '#fitness', 'icon' => 'fitness'],
            ['slug' => 'before-after-results', 'label' => '#before-after-results', 'icon' => 'sparkles'],
            ['slug' => 'fitness-journeys', 'label' => '#fitness-journeys', 'icon' => 'globe'],
            ['slug' => 'food', 'label' => '#food', 'icon' => 'food'],
            ['slug' => 'off-topic', 'label' => '#off-topic', 'icon' => 'chat'],
            ['slug' => 'feedback', 'label' => '#feedback', 'icon' => 'bulb'],
            ['slug' => 'tech-support', 'label' => '#tech-support', 'icon' => 'wrench'],
            ['slug' => 'looking-for-team', 'label' => '#looking-for-team', 'icon' => 'users'],
            ['slug' => 'announcements', 'label' => '#announcements', 'icon' => 'megaphone'],
        ];
    }

    /**
     * @return list<string>
     */
    public static function tags(): array
    {
        return ['All', 'Misc', 'Programs'];
    }

    /**
     * @return list<array<string, mixed>>
     */
    public static function threads(): array
    {
        return [
            [
                'id' => 1,
                'channel' => 'fitness',
                'author' => 'erijane',
                'tone' => 'brand',
                'title' => 'Welcome to the Erijane community',
                'snippet' => 'Share wins, ask questions, and support each other. This board is a visual shell — posting is not connected yet.',
                'tag' => 'Misc',
                'when' => 'pinned',
                'pinned' => true,
                'new' => false,
                'replies' => 12,
                'votes' => 7,
                'posted' => 90,
                'active' => 2,
            ],
            [
                'id' => 2,
                'channel' => 'fitness',
                'author' => 'coach',
                'tone' => 'ink',
                'title' => 'What program / workout should I do?',
                'snippet' => 'Start with a beginner-friendly challenge from Workout Programs, then layer videos for variety.',
                'tag' => 'Programs',
                'when' => '2 weeks ago',
                'pinned' => true,
                'new' => false,
                'replies' => 24,
                'votes' => 11,
                'posted' => 14,
                'active' => 1,
            ],
            [
                'id' => 3,
                'channel' => 'fitness',
                'author' => 'community',
                'tone' => 'muted',
                'title' => 'Resources megathread',
                'snippet' => 'Recipes, form tips, and apparel care — bookmark this thread as we grow the catalog.',
                'tag' => 'Misc',
                'when' => '1 month ago',
                'pinned' => true,
                'new' => false,
                'replies' => 8,
                'votes' => 5,
                'posted' => 30,
                'active' => 8,
            ],
            [
                'id' => 4,
                'channel' => 'fitness',
                'author' => 'member',
                'tone' => 'brand',
                'title' => 'Tips for staying on track',
                'snippet' => 'Small consistent sessions beat perfection. Track progress visually and celebrate non-scale wins.',
                'tag' => 'Misc',
                'when' => '3 days ago',
                'pinned' => false,
                'new' => true,
                'replies' => 3,
                'votes' => 2,
                'posted' => 3,
                'active' => 3,
            ],
            [
                'id' => 5,
                'channel' => 'fitness',
                'author' => 'coach',
                'tone' => 'ink',
                'title' => 'How many days a week should I lift as a beginner?',
                'snippet' => 'Two or three full-body sessions is plenty while you learn form. Rest days are part of the plan.',
                'tag' => 'Programs',
                'when' => '5 days ago',
                'pinned' => false,
                'new' => false,
                'replies' => 9,
                'votes' => 4,
                'posted' => 5,
                'active' => 4,
            ],
            [
                'id' => 6,
                'channel' => 'fitness',
                'author' => 'member',
                'tone' => 'muted',
                'title' => 'Low-impact options without jumping',
                'snippet' => 'Swap jumps for marching, step-touches, or floor work. Many Erijane videos label low-impact modifications.',
                'tag' => 'Programs',
                'when' => '1 week ago',
                'pinned' => false,
                'new' => false,
                'replies' => 6,
                'votes' => 3,
                'posted' => 7,
                'active' => 6,
            ],
            [
                'id' => 7,
                'channel' => 'fitness',
                'author' => 'erijane',
                'tone' => 'brand',
                'title' => 'How to enjoy working out',
                'snippet' => 'Pick music you like, keep sessions short at first, and treat the workout as a check-in with your body.',
                'tag' => 'Misc',
                'when' => '2 weeks ago',
                'pinned' => false,
                'new' => false,
                'replies' => 15,
                'votes' => 9,
                'posted' => 16,
                'active' => 9,
            ],
            [
                'id' => 8,
                'channel' => 'food',
                'author' => 'community',
                'tone' => 'ink',
                'title' => 'High-protein breakfast ideas',
                'snippet' => 'Browse the Recipes catalog for bowls, pancakes, and drinks that keep you full through a morning session.',
                'tag' => 'Misc',
                'when' => '4 days ago',
                'pinned' => false,
                'new' => true,
                'replies' => 4,
                'votes' => 2,
                'posted' => 4,
                'active' => 4,
            ],
            [
                'id' => 9,
                'channel' => 'announcements',
                'author' => 'erijane',
                'tone' => 'brand',
                'title' => 'Forum UI shell',
                'snippet' => 'Channels, search, and thread chrome are in place. Live posting and accounts for Save / votes come later.',
                'tag' => 'Misc',
                'when' => '1 week ago',
                'pinned' => true,
                'new' => false,
                'replies' => 1,
                'votes' => 3,
                'posted' => 7,
                'active' => 7,
            ],
        ];
    }

    /**
     * @return Collection<int, array<string, mixed>>
     */
    public static function visible(string $channel, string $q, string $sort, string $tag): Collection
    {
        $q = trim($q);
        $sort = $sort === 'active' ? 'active' : 'latest';

        $rows = collect(self::threads())
            ->filter(fn (array $thread) => $thread['channel'] === $channel)
            ->filter(function (array $thread) use ($q) {
                if ($q === '') {
                    return true;
                }

                $haystack = strtolower($thread['title'].' '.$thread['snippet']);

                return str_contains($haystack, strtolower($q));
            })
            ->filter(function (array $thread) use ($tag) {
                if ($tag === '' || $tag === 'All') {
                    return true;
                }

                return $thread['tag'] === $tag;
            });

        return $rows
            ->sort(function (array $a, array $b) use ($sort) {
                if ($a['pinned'] !== $b['pinned']) {
                    return $a['pinned'] ? -1 : 1;
                }
                if ($a['pinned'] && $b['pinned']) {
                    return $a['id'] <=> $b['id'];
                }

                $key = $sort === 'active' ? 'active' : 'posted';

                return $a[$key] <=> $b[$key];
            })
            ->values();
    }

    public static function channelLabel(string $slug): string
    {
        foreach (self::channels() as $channel) {
            if ($channel['slug'] === $slug) {
                return $channel['label'];
            }
        }

        return '#fitness';
    }
}
