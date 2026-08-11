<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\CatalogSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FilamentAdminFormsTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(CatalogSeeder::class);
    }

    public function test_admin_can_open_program_create_form(): void
    {
        $admin = User::factory()->admin()->create();

        $this->actingAs($admin)
            ->get('/admin/programs/create')
            ->assertOk()
            ->assertSee('title', false)
            ->assertSee('image', false);
    }

    public function test_admin_can_open_product_edit_form(): void
    {
        $admin = User::factory()->admin()->create();

        $this->actingAs($admin)
            ->get('/admin/products')
            ->assertOk()
            ->assertSee('Matcha Tank');
    }

    public function test_admin_can_open_site_settings(): void
    {
        $admin = User::factory()->admin()->create();
        $this->seed(\Database\Seeders\SiteContentSeeder::class);

        $this->actingAs($admin)
            ->get('/admin/site-settings')
            ->assertOk()
            ->assertSee('nav');
    }
}
