<?php

namespace Database\Seeders;

use App\Tbuy\Community\Models\Community;
 use Illuminate\Database\Seeder;


class CommunitySeeder extends Seeder
{
    public function run()
    {
        Community::factory()->count(10)->create();
    }
}

