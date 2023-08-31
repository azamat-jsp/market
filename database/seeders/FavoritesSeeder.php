<?php

namespace Database\Seeders;

use App\Tbuy\Product\Models\Product;
use App\Tbuy\User\Models\User;
use App\Tbuy\Vacancy\Models\Vacancy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Overtrue\LaravelFavorite\Favorite;

class FavoritesSeeder extends Seeder
{
    public function run(): void
    {
        $favoriteables = [
            Product::class,
            Vacancy::class,
        ];

        foreach ($favoriteables as $favoriteable) {
            /**
             * @var Model $favoriteable
             * @var Product $item
             */
            $sql = $favoriteable::query()->inRandomOrder()->take(random_int(3, 10));
            foreach ($sql->cursor() as $item) {
                $users = User::query()->inRandomOrder()->take(random_int(3, 10))->pluck('id')->map(function ($userId) {
                    return [
                        'user_id' => $userId
                    ];
                });

                $item->favorites()->createMany($users);
            }
        }
    }
}
