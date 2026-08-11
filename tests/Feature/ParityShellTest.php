<?php

namespace Tests\Feature;

use Database\Seeders\CatalogSeeder;
use Database\Seeders\SiteContentSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ParityShellTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(CatalogSeeder::class);
        $this->seed(SiteContentSeeder::class);
    }

    public function test_home_has_core_sections(): void
    {
        $this->get('/')
            ->assertOk()
            ->assertSee('Available Now')
            ->assertSee('Free Workout Programs')
            ->assertSee('Recent Workout Videos')
            ->assertSee('Merch')
            ->assertSee('Get more out of your fitness journey');
    }

    public function test_index_titles_match_live_shell(): void
    {
        $this->get('/programs')->assertOk()->assertSee('Latest Challenges');
        $this->get('/videos')->assertOk()->assertSee('Latest Workouts');
        $this->get('/recipes')->assertOk()->assertSee('Recipes');
        $this->get('/store')->assertOk()->assertSee('Merch');
    }

    public function test_auth_shell_titles(): void
    {
        $this->get('/login')->assertOk()->assertSee('Welcome Back!');
        $this->get('/signup')->assertOk()->assertSee('Track Your Progress');
    }

    public function test_footer_has_support_and_socials(): void
    {
        $this->get('/')
            ->assertOk()
            ->assertSee('Support')
            ->assertSee('Socials')
            ->assertSee('facebook.com/itschloeting', false);
    }

    public function test_community_page_uses_shared_cta(): void
    {
        $this->get('/community')
            ->assertOk()
            ->assertSee('Get more out of your fitness journey')
            ->assertSee('Today\'s workout', false)
            ->assertSee('#fitness')
            ->assertSee('Forum UI shell only', false)
            ->assertSee('Welcome to the Erijane community');
    }

    public function test_auth_pages_use_two_column_shell(): void
    {
        $this->get('/login')
            ->assertOk()
            ->assertSee('Welcome Back!')
            ->assertSee('Create an account to access features such as')
            ->assertSee('Log in with Google');

        $this->get('/signup')
            ->assertOk()
            ->assertSee('Track Your Progress')
            ->assertSee('Create an account to access features such as')
            ->assertSee('Sign up with Google');
    }

    public function test_listing_pages_have_live_chrome(): void
    {
        $this->get('/programs')
            ->assertOk()
            ->assertSee('Search by Collection')
            ->assertSee('Latest Challenges')
            ->assertSee('View Challenge');

        $this->get('/videos')
            ->assertOk()
            ->assertSee('Latest Workouts')
            ->assertSee('Load More Latest Workouts');

        $this->get('/recipes')
            ->assertOk()
            ->assertSee('Latest Recipes')
            ->assertSee('Load More Latest Recipes');

        $this->get('/about')
            ->assertOk()
            ->assertSee('Erijane')
            ->assertSee('engage that core', false);
    }
}
