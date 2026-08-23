<?php

namespace Tests\Feature;

use Database\Seeders\CatalogSeeder;
use Database\Seeders\SiteContentSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CommunityListingTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(CatalogSeeder::class);
        $this->seed(SiteContentSeeder::class);
    }

    public function test_community_index_matches_live_forums_chrome(): void
    {
        $this->get('/community')
            ->assertOk()
            ->assertSee('#fitness')
            ->assertSee('#before-after-results')
            ->assertSee('#announcements')
            ->assertSee('Create Post')
            ->assertSee('href="'.url('/login').'"', false)
            ->assertSee('Latest')
            ->assertSee('Last Active')
            ->assertSee('forum-all-btn', false)
            ->assertSee('Search')
            ->assertSee('ui-icon--search', false)
            ->assertSee('ui-icon--filters', false)
            ->assertSeeInOrder([
                'Welcome to the Erijane community',
                'What program / workout should I do?',
                'Resources megathread',
            ])
            ->assertSee('Replies')
            ->assertSee('Save')
            ->assertSee('Share')
            ->assertSee('forum-thread__actions', false)
            ->assertSee('+ New Post')
            ->assertDontSee('Get more out of your fitness journey')
            ->assertDontSee("Today's workout", false);
    }

    public function test_channel_query_scopes_threads(): void
    {
        $this->get('/community?channel=food')
            ->assertOk()
            ->assertSee('High-protein breakfast ideas')
            ->assertSee('>#food</h1>', false)
            ->assertDontSee('Welcome to the Erijane community');
    }

    public function test_search_filters_thread_titles(): void
    {
        $this->get('/community?q=Resources')
            ->assertOk()
            ->assertSee('Resources megathread')
            ->assertDontSee('Tips for staying on track');
    }

    public function test_live_path_redirects_to_community(): void
    {
        $this->get('/c/fitness-discussions')
            ->assertRedirect('/community');
    }
}
