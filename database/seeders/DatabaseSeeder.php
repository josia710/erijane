<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        User::factory()->create([
            'name' => 'Erijane Admin',
            'email' => 'admin@erijane.test',
            'password' => 'password',
            'role' => UserRole::Admin,
        ]);

        User::factory()->create([
            'name' => 'Erijane Editor',
            'email' => 'editor@erijane.test',
            'password' => 'password',
            'role' => UserRole::Editor,
        ]);

        User::factory()->create([
            'name' => 'Test Member',
            'email' => 'test@example.com',
            'password' => 'password',
            'role' => UserRole::Member,
        ]);

        $this->call([
            CatalogSeeder::class,
            SiteContentSeeder::class,
        ]);
    }
}
