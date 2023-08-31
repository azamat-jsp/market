<?php

namespace Database\Seeders;

use App\Tbuy\Product\Models\Product;
use App\Tbuy\Search\Model\SearchKeyWord;
use App\Tbuy\Search\Model\SearchKeyWordSearchable;
use Exception;
use Illuminate\Database\Seeder;

class SearchKeyWordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i <= 1000; $i++) {
            try {
                SearchKeyWord::query()->create([
                    'name' => fake()->word
                ]);
            } catch (Exception) {}
        }

        foreach (Product::query()->cursor() as $product) {
            /** @var Product $product */

            SearchKeyWordSearchable::query()->create([
                'key_word_id' => $product->id,
                'key_word_type' => Product::class,
                'search_key_word_id' => SearchKeyWord::query()->inRandomOrder()->first()->id
            ]);

        }
    }
}
