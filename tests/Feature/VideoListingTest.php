<?php

namespace Tests\Feature;

use Database\Seeders\CatalogSeeder;
use Database\Seeders\SiteContentSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VideoListingTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(CatalogSeeder::class);
        $this->seed(SiteContentSeeder::class);
    }

    public function test_videos_index_matches_live_listing_chrome(): void
    {
        $this->get('/videos')
            ->assertOk()
            ->assertSee('Browse By Collection')
            ->assertSee('placeholder="Search"', false)
            ->assertSee('Favorites')
            ->assertSee('Focus Area')
            ->assertSee('Workout Type')
            ->assertSee('Latest Workouts')
            ->assertSee('Most Popular')
            ->assertSee('These are some of the most popular workout videos', false)
            ->assertSee('Load More Latest Workouts')
            ->assertSee('class="videos-load-more"', false)
            ->assertSee('History')
            ->assertSee('Wrist Friendly')
            ->assertSee('ui-icon--search', false)
            ->assertSee('ui-icon--filters', false)
            ->assertDontSee('More Workouts')
            ->assertDontSee('Available Now');
    }

    public function test_collection_query_scopes_the_listing(): void
    {
        $this->get('/videos?collection=abs')
            ->assertOk()
            ->assertSee('Abs HIIT Workout')
            ->assertSee('>Abs</h2>', false)
            ->assertDontSee('Full Body Stretch');
    }

    public function test_search_filters_video_titles(): void
    {
        $this->get('/videos?q=Pilates')
            ->assertOk()
            ->assertSee('Pilates Core Flow')
            ->assertDontSee('Abs HIIT Workout');
    }
}
