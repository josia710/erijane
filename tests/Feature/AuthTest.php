<?php

namespace Tests\Feature;

use App\Enums\UserRole;
use App\Models\User;
use Database\Seeders\CatalogSeeder;
use Database\Seeders\SiteContentSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_register_as_member(): void
    {
        $response = $this->post('/signup', [
            'name' => 'Josia Test',
            'email' => 'josia@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertRedirect(route('home'));
        $this->assertAuthenticated();
        $this->assertDatabaseHas('users', [
            'email' => 'josia@example.com',
            'role' => UserRole::Member->value,
        ]);
    }

    public function test_user_can_login_and_logout(): void
    {
        $user = User::factory()->create([
            'email' => 'login@example.com',
            'password' => 'password123',
        ]);

        $this->post('/login', [
            'email' => 'login@example.com',
            'password' => 'password123',
        ])->assertRedirect(route('home'));

        $this->assertAuthenticatedAs($user);

        $this->post('/logout')->assertRedirect(route('home'));
        $this->assertGuest();
    }

    public function test_member_cannot_access_filament_panel(): void
    {
        $user = User::factory()->create(['role' => UserRole::Member]);

        $this->actingAs($user)
            ->get('/admin')
            ->assertForbidden();
    }

    public function test_admin_can_access_filament_panel(): void
    {
        $user = User::factory()->admin()->create();

        $this->actingAs($user)
            ->get('/admin')
            ->assertOk();
    }

    public function test_editor_can_access_filament_panel(): void
    {
        $user = User::factory()->editor()->create();

        $this->actingAs($user)
            ->get('/admin')
            ->assertOk();
    }

    public function test_signup_page_has_no_stub_alert(): void
    {
        $this->get('/signup')
            ->assertOk()
            ->assertDontSee('Sign up stub only')
            ->assertDontSee('no backend registration', false)
            ->assertSee('name="password_confirmation"', false);
    }

    public function test_local_chloe_images_exist(): void
    {
        $this->assertFileExists(public_path('images/chloe/hero/chloeting-banner.e2207dc5.png'));
        $this->assertFileExists(public_path('images/chloe/programs/2026-pilates-banner.jpeg'));
        $this->assertFileExists(public_path('images/chloe/store/matcha-tank-1.1f8f8f7a.jpg'));
        $this->assertFileExists(public_path('images/chloe/recipes/high-protein-square.webp'));
        $this->assertFileExists(public_path('images/chloe/videos/abs-booty-live.webp'));
    }

    public function test_design_system_fonts_and_disclaimer(): void
    {
        $this->seed(CatalogSeeder::class);
        $this->seed(SiteContentSeeder::class);

        $this->get('/')
            ->assertOk()
            ->assertSee('Manrope', false)
            ->assertDontSee('Poppins', false)
            ->assertDontSee('fonts.bunny.net/css?family=inter', false)
            ->assertSee('Not affiliated with the official Chloe Ting brand', false);
    }

    public function test_store_and_video_shells_have_no_alert_stubs(): void
    {
        $this->seed(CatalogSeeder::class);
        $this->seed(SiteContentSeeder::class);

        $this->get('/store/tee-classic')
            ->assertOk()
            ->assertDontSee('Cart stub', false)
            ->assertSee('Add to bag')
            ->assertSee('Catalog preview only', false)
            ->assertDontSee('Stripe', false)
            ->assertDontSee('Pay now', false);

        $this->get('/videos/abs-hiit')
            ->assertOk()
            ->assertDontSee('Video player stub', false)
            ->assertSee('Preview shell only', false);
    }
}
