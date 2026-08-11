<?php

namespace App\Providers;

use App\Models\CommunityFeature;
use App\Models\PageSection;
use App\Models\Product;
use App\Models\Program;
use App\Models\Recipe;
use App\Models\SiteSetting;
use App\Models\Video;
use App\Policies\CatalogPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Gate::policy(Program::class, CatalogPolicy::class);
        Gate::policy(Video::class, CatalogPolicy::class);
        Gate::policy(Recipe::class, CatalogPolicy::class);
        Gate::policy(Product::class, CatalogPolicy::class);
        Gate::policy(SiteSetting::class, CatalogPolicy::class);
        Gate::policy(PageSection::class, CatalogPolicy::class);
        Gate::policy(CommunityFeature::class, CatalogPolicy::class);
    }
}
