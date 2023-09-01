<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        try {
            \App\Models\User::factory()->create([
                'name' => 'Admin User',
                'email' => 'admin@govassist.com',
                'password' => 'govassist'
            ]);
        } catch (\Illuminate\Database\QueryException $e) {
            $this->command->warn('Already existing admin user.');
        }

        $this->call([
            UrlSeeder::class,
        ]);
    }
}
