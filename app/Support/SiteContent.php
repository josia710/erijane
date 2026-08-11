<?php

namespace App\Support;

use App\Models\CommunityFeature;
use App\Models\PageSection;
use App\Models\SiteSetting;
use Illuminate\Support\Collection;

class SiteContent
{
    public static function defaults(): array
    {
        static $defaults;

        return $defaults ??= require database_path('data/site_defaults.php');
    }

    public static function nav(): array
    {
        return SiteSetting::getValue('nav', self::defaults()['nav'] ?? []);
    }

    public static function socials(): array
    {
        return SiteSetting::getValue('socials', self::defaults()['socials'] ?? []);
    }

    public static function assets(): array
    {
        return SiteSetting::getValue('assets', self::defaults()['assets'] ?? []);
    }

    public static function communityFeatures(): Collection
    {
        $rows = CommunityFeature::query()->published()->orderBy('sort')->get();

        if ($rows->isNotEmpty()) {
            return $rows;
        }

        return collect(self::defaults()['community_features'] ?? [])->map(fn (array $row) => (object) $row);
    }

    public static function sections(string $page): Collection
    {
        return PageSection::query()->published()->forPage($page)->get();
    }

    public static function section(string $page, string $key): ?PageSection
    {
        return PageSection::query()
            ->published()
            ->where('page', $page)
            ->where('section_key', $key)
            ->first();
    }
}
