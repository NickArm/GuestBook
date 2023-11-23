<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocalBusinessCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            ['name' => 'Barber Shop'],
            ['name' => 'Beach Bars'],
            ['name' => 'Beaches'],
            ['name' => 'Casino'],
            ['name' => 'Coffee Shops'],
            ['name' => 'Grocery Stores'],
            ['name' => 'Museums'],
            ['name' => 'Night Club'],
            ['name' => 'Nightlife'],
            ['name' => 'Other'],
            ['name' => 'Restaurants'],
            ['name' => 'Super Markets'],
            ['name' => 'Wine bar'],
        ];

        DB::table('local_business_categories')->insert($categories);
    }
}
