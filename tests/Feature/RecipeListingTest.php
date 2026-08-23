<?php

namespace Tests\Feature;

use Database\Seeders\CatalogSeeder;
use Database\Seeders\SiteContentSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RecipeListingTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(CatalogSeeder::class);
        $this->seed(SiteContentSeeder::class);
    }

    public function test_recipes_index_matches_live_listing_chrome(): void
    {
        $this->get('/recipes')
            ->assertOk()
            ->assertSee('Browse By Collection')
            ->assertSee('placeholder="Search"', false)
            ->assertSee('Saved Recipes')
            ->assertSee('Course')
            ->assertSee('Dietary Restriction')
            ->assertSee('Latest Recipes')
            ->assertSee('Popular Categories')
            ->assertSee('Featured Recipes')
            ->assertSee('Here is a list of the most popular recipes', false)
            ->assertSee('Load More Latest Recipes')
            ->assertSee('View All Recipes')
            ->assertDontSee('Available Now')
            ->assertDontSee('>All</button>', false)
            ->assertSee('recipes-overlay', false)
            ->assertSee('recipes-rating-chip', false)
            ->assertSee('ui-icon--search', false)
            ->assertSee('ui-icon--filters', false);
    }

    public function test_collection_query_scopes_the_listing(): void
    {
        $this->get('/recipes?collection=berry')
            ->assertOk()
            ->assertSee('Berry Burrata Salad')
            ->assertSee('>Berry Delicious</h2>', false)
            ->assertDontSee('Vegetarian Stir Fry');
    }

    public function test_search_filters_recipe_titles(): void
    {
        $this->get('/recipes?q=Matcha')
            ->assertOk()
            ->assertSee('Vegan Matcha Latte')
            ->assertDontSee('High Protein Power Bowl');
    }
}
