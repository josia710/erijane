<?php

namespace Database\Seeders;

use App\Models\CommunityFeature;
use App\Models\PageSection;
use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteContentSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();
        $defaults = require database_path('data/site_defaults.php');

        SiteSetting::putValue('nav', $defaults['nav']);
        SiteSetting::putValue('assets', $defaults['assets']);
        SiteSetting::putValue('socials', $defaults['socials']);

        foreach ($defaults['community_features'] ?? [] as $i => $row) {
            CommunityFeature::query()->updateOrCreate(
                ['title' => $row['title']],
                [
                    'body' => $row['body'] ?? null,
                    'sort' => $i,
                    'published_at' => $now,
                ]
            );
        }

        $aboutSections = [
            [
                'section_key' => 'intro',
                'title' => 'Erijane',
                'body' => 'Erijane is a fitness clothing brand created to empower both men and women to feel confident in their bodies regardless of background, body type, or income level. Founded by a fitness influencer whose personal transformation journey began in 2015, Erijane is built on authenticity, resilience, education, research, community empowerment, and inclusivity.',
                'sort' => 0,
            ],
            [
                'section_key' => 'mission',
                'title' => 'Mission',
                'body' => 'To design and deliver affordable, durable, and stylish fitness clothing for men and women while motivating individuals through real-life transformation stories, inclusive fitness education, research, and community empowerment.',
                'sort' => 1,
            ],
            [
                'section_key' => 'vision',
                'title' => 'Vision',
                'body' => 'To become a globally trusted fitness apparel brand that inspires confidence, self-love, and strength in every body.',
                'sort' => 2,
            ],
            [
                'section_key' => 'values',
                'title' => 'Brand Values',
                'body' => 'Confidence · Inclusivity · Affordability · Authenticity · Faith & Resilience · Research-Driven Wellness',
                'meta' => [
                    'items' => [
                        ['label' => 'Confidence', 'text' => 'Helping people feel proud of their bodies'],
                        ['label' => 'Inclusivity', 'text' => 'Clothing for all genders, sizes, and income levels'],
                        ['label' => 'Affordability', 'text' => 'Quality fitness wear that everyone can afford'],
                        ['label' => 'Authenticity', 'text' => 'Built on real transformation and lived experience'],
                        ['label' => 'Faith & Resilience', 'text' => 'Rooted in perseverance and hope'],
                        ['label' => 'Research-Driven Wellness', 'text' => 'Evidence-based education and practical guidance'],
                    ],
                ],
                'sort' => 3,
            ],
            [
                'section_key' => 'story',
                'title' => 'Our Story',
                'body' => 'The brand was inspired by the founder’s experience with childhood bullying due to rickets-affected legs and the life-changing impact of exercise. Erijane aims to provide high-quality, affordable fitness apparel that removes financial barriers and encourages confidence through movement.',
                'sort' => 4,
            ],
            [
                'section_key' => 'impact',
                'title' => 'Social Impact',
                'body' => 'Erijane is more than a clothing brand. It represents hope, transformation, and self-belief — inspiring confidence through fitness, supporting underprivileged youth, and sharing faith-based education, community empowerment, and motivational stories.',
                'sort' => 5,
            ],
            [
                'section_key' => 'disclaimer',
                'title' => 'Study note',
                'body' => 'This local site uses Chloe Ting–style layout patterns for development practice. Not affiliated with, endorsed by, or an official product of Chloe Ting.',
                'sort' => 6,
            ],
        ];

        foreach ($aboutSections as $section) {
            PageSection::query()->updateOrCreate(
                [
                    'page' => 'about',
                    'section_key' => $section['section_key'],
                ],
                [
                    'title' => $section['title'],
                    'body' => $section['body'],
                    'meta' => $section['meta'] ?? null,
                    'sort' => $section['sort'],
                    'published_at' => $now,
                ]
            );
        }

        PageSection::query()->updateOrCreate(
            ['page' => 'home', 'section_key' => 'hero'],
            [
                'title' => 'Available Now',
                'body' => 'Affordable fitness apparel and free workout programs — built for every body.',
                'meta' => [
                    'cta_primary' => 'Shop the store',
                    'cta_primary_route' => 'store',
                    'cta_secondary' => 'Browse programs',
                    'cta_secondary_route' => 'programs',
                ],
                'sort' => 0,
                'published_at' => $now,
            ]
        );

        PageSection::query()->updateOrCreate(
            ['page' => 'community', 'section_key' => 'hero'],
            [
                'title' => 'Get more out of your fitness journey',
                'body' => 'Train with community support, track progress, and stay motivated — the Erijane way.',
                'sort' => 0,
                'published_at' => $now,
            ]
        );
    }
}
