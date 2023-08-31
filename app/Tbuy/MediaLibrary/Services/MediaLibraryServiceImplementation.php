<?php

namespace App\Tbuy\MediaLibrary\Services;

use App\Tbuy\MediaLibrary\DTOs\FileDTO;
use App\Tbuy\MediaLibrary\Enums\MediaLibraryCollection;
use App\Tbuy\MediaLibrary\Repositories\MediaLibraryRepository;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Collection;
use Spatie\MediaLibrary\HasMedia;

class MediaLibraryServiceImplementation implements MediaLibraryService
{
    public function __construct(
        private readonly MediaLibraryRepository $libraryRepository
    )
    {
    }

    public function addAllMedia(HasMedia $model, array|Collection $files, MediaLibraryCollection $collection): bool
    {
        $files = is_array($files)
            ? collect($files)
            : $files;

        $files->ensure(FileDTO::class);

        $files->each(
            fn(FileDTO $file) => $this->libraryRepository->addMedia($model, $file->file, $collection)
        );

        return true;
    }

    public function deleteFileSelectively(HasMedia $model, array|Collection $payload, MediaLibraryCollection $collection): bool
    {

        $payload = is_array($payload)
            ? collect($payload)
            : $payload;

        $payload->ensure(FileDTO::class);

        $allMedia = $this->libraryRepository->getMedia($model, $collection);

        $payload->each(function (FileDTO $new_file) use ($allMedia, $model, $collection) {

            if ($media = $allMedia->where('file_name', '=', $new_file->name)->first()) {
                $media->delete();
                $this->libraryRepository->addMedia(
                    model: $model,
                    file: $new_file->file,
                    collection: $collection
                );
            }

        });

        return true;
    }
}
