<?php

namespace Database\Seeders;

use App\Tbuy\Resume\Model\Resume;
use Illuminate\Database\Seeder;

class ResumeSeeder extends Seeder
{
    public function run(): void
    {
        Resume::factory(30)->create();
    }
}
