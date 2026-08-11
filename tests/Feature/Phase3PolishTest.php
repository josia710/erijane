<?php

namespace Tests\Feature;

use App\Support\Media;
use Database\Seeders\CatalogSeeder;
use Database\Seeders\SiteContentSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class Phase3PolishTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(CatalogSeeder::class);
        $this->seed(SiteContentSeeder::class);
    }

    public function test_config_no_longer_holds_catalog_arrays(): void
    {
        $this->assertArrayNotHasKey('programs', config('chloe'));
        $this->assertArrayNotHasKey('videos', config('chloe'));
        $this->assertArrayNotHasKey('recipes', config('chloe'));
        $this->assertArrayNotHasKey('store', config('chloe'));
        $this->assertFileExists(database_path('data/catalog.php'));
        $this->assertFileExists(database_path('data/site_defaults.php'));
    }

    public function test_media_falls_back_to_placeholder(): void
    {
        $url = Media::url('images/does-not-exist/missing.jpg');
        $this->assertStringContainsString('erijane/icon-112.png', $url);
    }

    public function test_store_cart_shell_has_no_payment_cta(): void
    {
        $this->get('/store/tee-classic')
            ->assertOk()
            ->assertSee('payments and shipping are not enabled', false)
            ->assertSee('No payment processor', false)
            ->assertDontSee('Proceed to checkout', false);
    }

    public function test_empty_store_filter_shows_empty_state(): void
    {
        $this->get('/store?category=Equipment')
            ->assertOk()
            ->assertSee('No products in this category');
    }
}
