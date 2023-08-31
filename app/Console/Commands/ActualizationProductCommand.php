<?php

namespace App\Console\Commands;

use App\Tbuy\Product\Enums\ProductOverDate;
use App\Tbuy\Product\Enums\ProductStatus;
use App\Tbuy\Product\Models\Product;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Builder;

class ActualizationProductCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'products:actualization';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set as not active if product amount is 0 or activated 60 days ago';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Product::where(function (Builder $q) {
            $q->where('amount',  0)
                ->orWhereBetween(
                    'accepted_at', [
                        now()->subDays(ProductOverDate::LEFT_DAYS_COUNT->value)->startOfDay(),
                        now()->subDays(ProductOverDate::LEFT_DAYS_COUNT->value)->endOfDay()
                    ]
                );
        })->update([
            'status' => ProductStatus::NEED_UPDATE->value
        ]);
    }
}
