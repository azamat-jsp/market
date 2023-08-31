<?php

namespace App\Tbuy\Company\Repositories;

use App\Contracts\SearchRatingCalculationContract;
use App\DTOs\BaseDTO;
use App\Tbuy\Company\DTOs\CompanyDataConfirmationDTO;
use App\Tbuy\Company\DTOs\CompanyDTO;
use App\Tbuy\Company\DTOs\CompanyFilterDTO;
use App\Tbuy\Company\DTOs\CompanyStatusDTO;
use App\Tbuy\Company\Models\Company;
use App\Tbuy\Company\SearchRatingCalculations\CalculateCompanyDisabledProductsCount;
use App\Tbuy\Company\SearchRatingCalculations\CalculateCompanyHasTariff;
use App\Tbuy\Company\SearchRatingCalculations\CalculateComplaints;
use App\Tbuy\Company\SearchRatingCalculations\CalculatePromotionsCount;
use App\Tbuy\Company\SearchRatingCalculations\CalculatePurchasesRefunds;
use App\Tbuy\Company\SearchRatingCalculations\CalculateSocialEntriesCount;
use App\Tbuy\Company\SearchRatingCalculations\CompanySubscribersCountCalculation;
use App\Tbuy\Company\SearchRatingCalculations\CountGiftCardsAmount;
use App\Tbuy\Company\SearchRatingCalculations\ProductPurchasesCountCalculation;
use App\Tbuy\Company\SearchRatingCalculations\ProductsImagesDivisionOnProducts;
use App\Tbuy\Company\SearchRatingCalculations\ProductUpdateCountCalculation;
use App\Tbuy\Product\Calculations\CountGiftCardsByCompanies;
use App\Tbuy\Purchase\Models\ProductPurchase;
use App\Tbuy\Refund\Models\Refund;
use App\Tbuy\Vacancy\DTOs\VacancyFilterDTO;
use App\Traits\HasPaginate;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;


class CompanyRepositoryImplementation implements CompanyRepository
{
    const COEFFICIENT = 500;

    use HasPaginate;

    public array $searchRatingCalculations = [
        "company_disabled_products" => CalculateCompanyDisabledProductsCount::class,
        "company_has_tariff" => CalculateCompanyHasTariff::class,
        "promotions" => CalculatePromotionsCount::class,
        "social_entries" => CalculateSocialEntriesCount::class,
        "company_subscribers" => CompanySubscribersCountCalculation::class,
        "gift_cards_amount" => CountGiftCardsAmount::class,
        "product_purchases" => ProductPurchasesCountCalculation::class,
        "products_images_division_on_products" => ProductsImagesDivisionOnProducts::class,
        "product_update_count" => ProductUpdateCountCalculation::class,
        "complaints" => CalculateComplaints::class,
        "purchases_refunds" => CalculatePurchasesRefunds::class,
        "gift_cards_by_companies" => CountGiftCardsByCompanies::class
    ];

    public function get(CompanyFilterDTO $payload): Collection
    {
        return Company::filter($payload->toArray())
            ->with([
                'logo',
                'brands',
                'ratings',
                'children',
                'brandDocument',
                'passportDocument',
                'stateRegisterDocument'
            ])
            ->get();
    }

    public function getBuilder(CompanyFilterDTO $payload): Builder
    {
        return Company::filter($payload->toArray())
            ->with([
                'logo',
                'brands',
                'ratings',
                'children',
                'brandDocument',
                'passportDocument',
                'stateRegisterDocument'
            ]);
    }

    public function create(CompanyDTO $payload): Company
    {
        $company = new Company((array)$payload);

        $company->save();

        return $company;
    }

    public function update(Company $company, BaseDTO $payload): Company
    {
        $company->fill(array_filter((array)$payload));
        $company->save();

        return $company;
    }

    public function delete(Company $company): bool
    {
        return $company->delete();
    }

    public function setStatus(Company $company, CompanyStatusDTO $payload): Company
    {
        $company->fill([
            'status' => $payload->status
        ]);
        $company->save();

        return $company;
    }

    public function getById(int $companyId): Company
    {
        /** @var Company $company */
        $company = Company::query()
            ->with([
                'children',
                'brandDocument',
                'passportDocument',
                'stateRegisterDocument'
            ])
            ->find($companyId);

        return $company;
    }

    /**
     * @param Company $company
     * @return float|int
     */
    public function purchasesRefunds(Company $company): float|int
    {
        $productIds = $company->load('products')->products->pluck('id')->toArray();
        $purchases = ProductPurchase::query()->whereIn('product_id', $productIds)->count();
        $refunds = Refund::query()->whereIn('product_id', $productIds)->count();

        return ($purchases / ($refunds == 0 ? 1 : $refunds)) * self::COEFFICIENT;
    }

    public function score(Company $company, ?int $score): Company
    {
        $company->ratings()
            ->detach([
                'user_id' => auth()->id()
            ]);

        if ($score) {
            $company->ratings()->attach(['user_id' => auth()->id()], ['rating' => $score]);
        }

        return $company;
    }

    public function updateFieldsDataConfirmation(Company $company, CompanyDataConfirmationDTO $payload): Company
    {
        $company->update([
            'bank_account' => $payload->bank_account,
            'tariff_conditions_accepted_at' => $payload->tariff_conditions_accepted_at,
            'basic_agreement_accepted_at' => $payload->basic_agreement_accepted_at,
        ]);

        return $company->fresh();
    }

    public function getEmployeesByCompany(Company $company): Collection
    {
        return $company->employees;
    }

    public function getsInfoByCompany(Company $company): array
    {
        return $company->only(['id', 'legal_name_company', 'description', 'email']);
    }

    public function getVacanciesByCompany(Company $company, VacancyFilterDTO $dto): Builder
    {
        return $company->vacancies()
            ->orderByDesc('created_at')
            ->orderByDesc('deadline')
            ->withCount(['clicks', 'views'])
            ->filter($dto->toArray())
            ->getQuery();
    }

    public function getScoresByCompany(Company $company): array
    {
        $data = [];

        if (property_exists($this, 'searchRatingCalculations') && count($this->searchRatingCalculations)) {
            foreach ($this->searchRatingCalculations as $name => $calculation) {
                /**
                 * @var SearchRatingCalculationContract $calculation
                 */
                $sum = (new $calculation())->calculate($company);
                $data[$name] = $sum;

            }
        }

        return $data;
    }

    public function updateDomain(Company $company, string $domain): Company
    {
        $company->fill([
            'domain' => $domain,
            'domain_updated_at' => now()
        ]);

        $company->saveOrFail();

        return $company;
    }
}
