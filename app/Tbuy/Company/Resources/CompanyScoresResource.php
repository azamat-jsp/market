<?php

namespace App\Tbuy\Company\Resources;

use App\Tbuy\Company\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property-read Company $resource
 */
class CompanyScoresResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray(Request $request): array
    {
        return [
            "company_disabled_products" => $this['company_disabled_products'],
            "company_has_tariff" => $this['company_has_tariff'],
            "promotions" => $this['promotions'],
            "social_entries" => $this['social_entries'],
            "company_subscribers" => $this['company_subscribers'],
            "gift_cards_amount" => $this['gift_cards_amount'],
            "product_purchases" => $this['product_purchases'],
            "products_images_division_on_products" => $this['products_images_division_on_products'],
            "product_update_count" => $this['product_update_count'],
            "complaints" => $this['complaints'],
            "purchases_refunds" => $this['purchases_refunds'],
            "gift_cards_by_companies" => $this['gift_cards_by_companies'],
        ];
    }
}
