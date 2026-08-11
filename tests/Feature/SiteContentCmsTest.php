<?php

namespace Tests\Feature;

use App\Models\PageSection;
use App\Models\SiteSetting;
use App\Support\SiteContent;
use Database\Seeders\CatalogSeeder;
use Database\Seeders\SiteContentSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SiteContentCmsTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(CatalogSeeder::class);
        $this->seed(SiteContentSeeder::class);
    }

    public function test_site_settings_drive_nav(): void
    {
        $this->assertNotEmpty(SiteContent::nav());
        $this->assertDatabaseHas('site_settings', ['key' => 'nav']);
    }

    public function test_about_page_shows_erijane_mission(): void
    {
        $this->get('/about')
            ->assertOk()
            ->assertSee('Mission')
            ->assertSee('affordable, durable, and stylish fitness clothing', false)
            ->assertSee('Brand Values');
    }

    public function test_home_hero_uses_page_section(): void
    {
        $this->assertNotNull(SiteContent::section('home', 'hero'));

        $this->get('/')
            ->assertOk()
            ->assertSee('Available Now')
            ->assertSee('Affordable fitness apparel', false);
    }

    public function test_community_uses_cms_features(): void
    {
        $this->get('/community')
            ->assertOk()
            ->assertSee('Get more out of your fitness journey')
            ->assertSee('Personal daily workout schedule');
    }

    public function test_updating_site_setting_changes_nav_label(): void
    {
        $nav = SiteSetting::getValue('nav');
        $nav[1]['label'] = 'Programs CMS';
        SiteSetting::putValue('nav', $nav);

        $this->get('/')
            ->assertOk()
            ->assertSee('Programs CMS');
    }

    public function test_unpublished_about_section_is_hidden(): void
    {
        PageSection::query()->where('page', 'about')->where('section_key', 'mission')->update([
            'published_at' => null,
        ]);

        $this->get('/about')
            ->assertOk()
            ->assertDontSee('affordable, durable, and stylish fitness clothing', false);
    }
}
