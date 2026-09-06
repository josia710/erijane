<?php

namespace Tests\Feature;

use Database\Seeders\CatalogSeeder;
use Database\Seeders\SiteContentSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AboutPageTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(CatalogSeeder::class);
        $this->seed(SiteContentSeeder::class);
    }

    public function test_about_matches_live_listing_chrome(): void
    {
        $this->get('/about')
            ->assertOk()
            ->assertSee('about-hero', false)
            ->assertSee('Erijane')
            ->assertSee('Affordable fitness apparel')
            ->assertSee('rickets-affected', false)
            ->assertSee('Brand Values')
            ->assertSee('Confidence')
            ->assertSee('Mission')
            ->assertSee('engage that core', false)
            ->assertDontSee('Awards & Achievements')
            ->assertDontSee('Walmart');
    }
}
