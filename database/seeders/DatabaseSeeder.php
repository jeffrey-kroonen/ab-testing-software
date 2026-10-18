<?php

declare(strict_types=1);

namespace Database\Seeders;

use Database\Factories\UserFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use function Laravel\Prompts\info;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = UserFactory::new([
            'name' => 'Default User',
            'email' => 'user@mail.com',
        ])
        ->create();

        $token = $user->createToken('default');

        info('User created with Personal Access Token: ' . $token->plainTextToken);
    }
}
