<?php

namespace App\Jobs;

use App\Tbuy\MediaLibrary\Enums\MediaLibraryCollection;
use App\Tbuy\Product\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\HasMedia;

class ParseFakeImageJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        private readonly HasMedia               $model,
        private readonly MediaLibraryCollection $collection
    )
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->model->copyMedia(storage_path('fake/fake.jpg'))
            ->toMediaCollection($this->collection->value);
    }
}
