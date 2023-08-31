<?php

namespace Database\Seeders;

use App\Jobs\ParseFakeImageJob;
use App\Tbuy\Banner\Models\Banner;
use App\Tbuy\MediaLibrary\Enums\MediaLibraryCollection;
use Illuminate\Database\Seeder;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Banner::factory(400)->create()->each(function (Banner $banner) {
            ParseFakeImageJob::dispatch($banner, MediaLibraryCollection::BANNER_FILE);
        });
    }
}
