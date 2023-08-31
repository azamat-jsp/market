<?php

namespace Database\Seeders;

use App\Tbuy\Gallery\Model\Gallery;
use Illuminate\Database\Seeder;

class GallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Gallery::factory(100)->create();
    }
}
