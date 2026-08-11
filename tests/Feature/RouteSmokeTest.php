<?php

namespace Tests\Feature;

use Database\Seeders\CatalogSeeder;
use Database\Seeders\SiteContentSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RouteSmokeTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(CatalogSeeder::class);
        $this->seed(SiteContentSeeder::class);
    }

    public static function routesProvider(): array
    {
        return [
            ['/'],
            ['/programs'],
            ['/programs/2026-pilates-challenge'],
            ['/videos'],
            ['/videos/abs-hiit'],
            ['/recipes'],
            ['/recipes/protein-bowl'],
            ['/store'],
            ['/store/tee-classic'],
            ['/community'],
            ['/about'],
            ['/login'],
            ['/signup'],
        ];
    }

    #[\PHPUnit\Framework\Attributes\DataProvider('routesProvider')]
    public function test_route_returns_ok(string $uri): void
    {
        $this->get($uri)->assertOk();
    }

    public function test_journey_redirects_to_login(): void
    {
        $this->get('/journey')->assertRedirect(route('login'));
    }

    public function test_unknown_program_returns_not_found(): void
    {
        $this->get('/programs/does-not-exist')->assertNotFound();
    }

    public function test_admin_login_page_is_reachable(): void
    {
        $this->get('/admin/login')->assertOk();
    }
}
