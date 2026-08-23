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
        $accounts = [
            ['email' => 'admin@erijane.test', 'name' => 'Erijane Admin', 'role' => UserRole::Admin],
            ['email' => 'editor@erijane.test', 'name' => 'Erijane Editor', 'role' => UserRole::Editor],
            ['email' => 'test@example.com', 'name' => 'Test Member', 'role' => UserRole::Member],
        ];

        foreach ($accounts as $account) {
            User::query()->updateOrCreate(
                ['email' => $account['email']],
                [
                    'name' => $account['name'],
                    'password' => 'password',
                    'role' => $account['role'],
                ]
            );
        }

        $this->call([
            CatalogSeeder::class,
            SiteContentSeeder::class,
        ]);
    }
}
