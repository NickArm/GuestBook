<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            LocalBusinessCategorySeeder::class,
            PropertyGuideCategorySeeder::class,
            FaqCategorySeeder::class,
            RoleAndPermissionSeeder::class,
            // ... other seeders
        ]);
    }
}
