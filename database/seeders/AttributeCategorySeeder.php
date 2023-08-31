<?php

namespace Database\Seeders;

use App\Tbuy\AttributeCategory\Models\AttributeCategory;
use Illuminate\Database\Seeder;

class AttributeCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AttributeCategory::factory(10)->create();
    }
}
