<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PropertyGuideCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            ['name' => 'Default'],
            ['name' => 'Security'],
            ['name' => 'Kitchen'],
            ['name' => 'Bathroom'],
            ['name' => 'Living Room'],
            ['name' => 'Leaving The House'],
            ['name' => 'Bedrooms'],
            ['name' => 'Terrace'],
        ];

        DB::table('property_guide_categories')->insert($categories);
    }
}
