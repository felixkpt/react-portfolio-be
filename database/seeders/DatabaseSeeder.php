<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Database\Seeders\Admin\AdminRoleSeeder;
use Database\Seeders\Admin\AdminUserSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $arr = [
            StatusSeeder::class,
            AdminUserSeeder::class,
            AdminRoleSeeder::class,
            PostStatusSeeder::class,
            PermissionSeeder::class,
        ];

        // shuffle($arr);

        $this->call($arr);

        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
 
    }
}
