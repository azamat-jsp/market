<?php

namespace App\Jobs\ImportJobs;

use App\Tbuy\Brand\Enums\BrandStatus;
use App\Tbuy\Brand\Models\Brand;
use App\Tbuy\Product\Enums\ProductStatus;
use App\Tbuy\Product\Enums\ProductType;
use App\Tbuy\Product\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class ProductsImport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    const PRODUCTS_TABLE = 'nv_product';

    /**
     * Create a new job instance.
     */
    public function __construct()
    {

    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //
        DB::connection('mysql_old')->table(self::PRODUCTS_TABLE)->orderBy('product_id')->chunk(1000, function ($productsOld) {
            dump("data got");
            $brands = collect();
            $date = now()->toDateTimeString();

            $products = [];

            foreach ($productsOld as $product) {
                if (is_null($brand = $brands->where('name', 'LIKE', '%' . $product->product_brand . '%')->first())) {
                    $brand = Brand::query()->where('name', 'LIKE', '%' . $product->product_brand . '%')->first();

                    if (!$brand) {
                        dump("create brand");
                        $brand = Brand::query()->create([
                            'name' => json_encode([
                                'ru' => $product->product_brand,
                                'en' => $product->product_brand,
                                'hy' => $product->product_brand
                            ]),
                            'company_id' => 1,
                            'country_id' => 1,
                            'date' => $date,
                            'status' => BrandStatus::ACCEPTED,
                            'description' => null
                        ]);

                        $brands->add($brand);
                    }
                }

//                $table->string('name');
//                $table->json('description')->nullable();
//                $table->decimal('amount', 12);
//                $table->decimal('price', 12);
//                $table->enum('type', ProductType::values())->default(ProductType::DEFAULT->value);
//                $table->boolean('active');
//                $table->string('color');
//                $table->decimal('size', 12);
//                $table->boolean('before_declined')->default(false);
//                $table->foreignId('brand_id')->constrained();
//                $table->foreignId('category_id')->constrained();
//                $table->dateTime('accepted_at')->nullable();
//                $table->string('status')->default(ProductStatus::WAITING->value);
//                $table->integer('update_count')->default(0);
//                $table->unsignedInteger('views')->default(0);

                $products[] = [
                    'id' => $product->product_id,
                    'name' => json_encode([
                        'ru' => $product->product_full_name,
                        'en' => $product->product_full_name,
                        'hy' => $product->product_full_name
                    ]),
                    'description' => json_encode([
                        'ru' => $product->product_description,
                        'en' => $product->product_description,
                        'hy' => $product->product_description
                    ]),
                    'amount' => 0,
                    'price' => $product->praduct_price,
                    'type' => ProductType::DEFAULT->value,
                    'active' => true,
                    'color' => null,
                    'size' => 1,
                    'before_declined' => false,
                    'brand_id' => $brand->id,
                    'category_id' => $product->product_category,
                    'accepted_at' => $date,
                    'status' => ProductStatus::CONFIRMED->value,
                    'update_count' => 0,
                    'views' => 0,
                    'created_at' => $date,
                    'updated_at' => $date,
                ];
            }

            dump("Start insert");
            Product::query()->insert($products);
            dump("Stop insert");
        });
    }
}
