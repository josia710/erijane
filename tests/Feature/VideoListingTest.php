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
            ->assertSee('wire:click="loadMoreLatest"', false)
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

    public function test_seeded_youtube_videos_link_out(): void
    {
        $this->get('/videos')
            ->assertOk()
            ->assertSee('Calorie Killer HIIT');

        $this->get('/videos/seven-minute-hiit')
            ->assertOk()
            ->assertSee('Watch on YouTube')
            ->assertSee('https://youtu.be/HX7X1o2O9Uw', false);
    }

    public function test_video_categories_are_seeded_and_cover_videos(): void
    {
        $this->assertSame(7, \App\Models\VideoCategory::query()->count());

        $known = \App\Models\VideoCategory::query()->pluck('name')->all();
        foreach (\App\Models\Video::query()->pluck('category')->unique() as $category) {
            $this->assertContains($category, $known);
        }
    }

    public function test_show_page_embeds_youtube_in_frame(): void
    {
        $video = \App\Models\Video::query()->where('slug', 'seven-minute-hiit')->firstOrFail();

        $this->assertSame('HX7X1o2O9Uw', $video->youtube_id);

        $this->get(route('videos.show', $video))
            ->assertOk()
            ->assertSee('youtube.com/embed/HX7X1o2O9Uw', false)
            ->assertSee('allowfullscreen', false)
            ->assertSee('picture-in-picture', false)
            ->assertSee('id="video-play"', false)
            ->assertSee('id="video-minimize"', false);
    }
}
