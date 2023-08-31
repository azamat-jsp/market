<?php

namespace App\Jobs\ImportJobs;

use App\Tbuy\Category\Enums\CategoryStatus;
use App\Tbuy\Category\Models\Category;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class CategoriesImport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        protected readonly Collection $categories
    )
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {


        $date = now()->toDateTimeString();

        $categories = $this->categories->map(function (object $category) use ($date) {
            return [
                'id' => $category->cat_id,
                'logo' => null,
                'icon' => null,
                'parent_id' => $category->master_id == 0 ? null : $category->master_id,
                'name' => json_encode([
                    'ru' => $category->cat_name_ru,
                    'en' => $category->cat_name_en,
                    'hy' => $category->cat_name_am
                ]),
                'position' => null,
                'is_active' => false,
                'min_images' => null,
                'form_description' => false,
                'offer_services' => false,
                'description' => null,
                'status' => CategoryStatus::ACTIVE->value,
                'created_at' => $date,
                'updated_at' => $date,
            ];
        });

        Category::query()->insert($categories->toArray());
    }
}
