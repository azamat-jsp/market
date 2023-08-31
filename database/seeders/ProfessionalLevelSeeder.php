<?php

namespace Database\Seeders;

use App\Tbuy\ProfessionalLevel\Models\ProfessionalLevel;
use Illuminate\Database\Seeder;

class ProfessionalLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProfessionalLevel::factory(5)
            ->create();
    }
}
