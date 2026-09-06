<?php

namespace Tests\Feature;

use Database\Seeders\CatalogSeeder;
use Database\Seeders\SiteContentSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProgramListingTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(CatalogSeeder::class);
        $this->seed(SiteContentSeeder::class);
    }

    public function test_programs_index_matches_live_listing_chrome(): void
    {
        $this->get('/programs')
            ->assertOk()
            ->assertSee('Available Now')
            ->assertSee('hero-collage', false)
            ->assertSee('performance-audit', false)
            ->assertSee('track-kcal-out', false)
            ->assertSee('Browse By Collection')
            ->assertSee('placeholder="Search"', false)
            ->assertDontSee('Search by Collection')
            ->assertSee('Focus Area')
            ->assertSee('Beginner Friendly')
            ->assertSee('No Equipment')
            ->assertSee('Looking to get started on your fitness journey', false)
            ->assertSee('program-meta-chip', false)
            ->assertSee('ui-icon--search', false)
            ->assertSee('ui-icon--filters', false)
            ->assertSee('ui-icon--meta-cal', false);
    }

    public function test_collection_query_scopes_the_listing(): void
    {
        $this->get('/programs?collection=abs')
            ->assertOk()
            ->assertSee('2026 Pilates Challenge')
            ->assertSee('>Abs</h2>', false)
            ->assertDontSee('Booty Building Program');
    }

    public function test_search_filters_program_titles(): void
    {
        $this->get('/programs?q=Hourglass')
            ->assertOk()
            ->assertSee('Hourglass Challenge')
            ->assertDontSee('2026 Pilates Challenge');
    }

    public function test_complete_toggle_marks_program_in_session(): void
    {
        $program = \App\Models\Program::query()->published()->firstOrFail();

        $this->post(route('programs.complete', $program))
            ->assertRedirect(route('programs.show', $program));

        $this->get(route('programs.show', $program))
            ->assertOk()
            ->assertSee('Completed', false);

        $this->post(route('programs.complete', $program));

        $this->get(route('programs.show', $program))
            ->assertOk()
            ->assertSee('Mark as complete');
    }

    public function test_history_filter_scopes_by_session_completion(): void
    {
        $program = \App\Models\Program::query()->published()->firstOrFail();

        $this->withSession(['completed_programs' => [$program->slug]])
            ->get('/programs?collection=all&history%5B0%5D=not-completed')
            ->assertOk()
            ->assertDontSee($program->title);
    }
}
