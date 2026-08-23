<?php

namespace Tests\Feature;

use App\Enums\UserRole;
use App\Models\Program;
use App\Models\Recipe;
use App\Models\User;
use Database\Seeders\CatalogSeeder;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CatalogCmsTest extends TestCase
{
    use RefreshDatabase;

    public function test_catalog_seeder_publishes_programs(): void
    {
        $this->seed(CatalogSeeder::class);

        $this->assertGreaterThan(0, Program::query()->published()->count());
        $this->get('/programs/2026-pilates-challenge')->assertOk();
    }

    public function test_database_seeder_is_idempotent(): void
    {
        $this->seed(DatabaseSeeder::class);
        $this->seed(DatabaseSeeder::class);

        $this->assertSame(3, User::query()->count());
        $this->assertGreaterThan(0, Recipe::query()->published()->count());
        $this->get('/')->assertOk();
    }

    public function test_seeded_catalog_images_exist_on_disk(): void
    {
        $catalog = require database_path('data/catalog.php');

        foreach (['programs', 'videos', 'recipes', 'store'] as $group) {
            foreach ($catalog[$group] as $row) {
                $this->assertFileExists(public_path($row['image']), $row['image']);
            }
        }
    }

    public function test_admin_can_create_program_via_eloquent_policy(): void
    {
        $admin = User::factory()->admin()->create();
        $this->assertTrue($admin->can('create', Program::class));

        $member = User::factory()->create(['role' => UserRole::Member]);
        $this->assertFalse($member->can('create', Program::class));
    }

    public function test_unpublished_program_is_not_found_publicly(): void
    {
        Program::query()->create([
            'slug' => 'draft-only',
            'title' => 'Draft',
            'tone' => 'mint',
            'weeks' => 2,
            'level' => 'Beginner',
            'focus' => 'Core',
            'published_at' => null,
        ]);

        $this->get('/programs/draft-only')->assertNotFound();
    }
}
