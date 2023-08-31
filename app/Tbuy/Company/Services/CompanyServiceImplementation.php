<?php

namespace App\Tbuy\Company\Services;

use App\Tbuy\Company\DTOs\CompanyClientDTO;
use App\Tbuy\Company\DTOs\CompanyClientLogoDTO;
use App\Tbuy\Company\DTOs\CompanyDataConfirmationDTO;
use App\Tbuy\Company\DTOs\CompanyDTO;
use App\Tbuy\Company\DTOs\CompanyFilterDTO;
use App\Tbuy\Company\DTOs\CompanyStatusDTO;
use App\Tbuy\Company\DTOs\CompanyUpdateDTO;
use App\Tbuy\Company\Enums\CacheKeys;
use App\Tbuy\Company\Events\CompanyRejected;
use App\Tbuy\Company\Models\Company;
use App\Tbuy\Company\Notifications\SendEmailWithLinkForPassword;
use App\Tbuy\Company\Repositories\CompanyRepository;
use App\Tbuy\Company\Requests\SendEmailRequest;
use App\Tbuy\MediaLibrary\Enums\MediaLibraryCollection;
use App\Tbuy\MediaLibrary\Repositories\MediaLibraryRepository;
use App\Tbuy\MediaLibrary\Services\MediaLibraryService;
use App\Tbuy\Rejection\Repository\RejectionRepository;
use App\Tbuy\User\DTOs\UserDTO;
use App\Tbuy\User\Models\User;
use App\Tbuy\User\Repositories\UserRepository;
use App\Tbuy\Vacancy\DTOs\VacancyFilterDTO;
use App\Traits\HasSubscribers;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class CompanyServiceImplementation implements CompanyService
{
    public function __construct(
        private readonly CompanyRepository      $companyRepository,
        private readonly MediaLibraryRepository $libraryRepository,
        private readonly MediaLibraryService    $libraryService,
        private readonly RejectionRepository    $rejectionRepository,
        private readonly UserRepository         $userRepository
    )
    {
    }

    use HasSubscribers;

    public function get(CompanyFilterDTO $filters): LengthAwarePaginator
    {
        return Cache::tags(CacheKeys::COMPANY_TAG->value)
            ->remember(
                CacheKeys::COMPANY_LIST->setKeys($filters),
                CacheKeys::ttl(),
                fn() => $this->companyRepository->paginate(
                    builder: $this->companyRepository->getBuilder($filters),
                    perPage: $filters->perPage,
                )
            );
    }

    public function store(CompanyDTO $dto): Company
    {
        $company = $this->companyRepository->create($dto);

        $this->libraryRepository->addMedia(
            $company,
            $dto->passport_document,
            MediaLibraryCollection::COMPANY_PASSPORT_DOCUMENT
        );

        $this->libraryRepository->addMedia(
            $company,
            $dto->state_register_document,
            MediaLibraryCollection::COMPANY_STATE_REGISTER_DOCUMENT
        );

        Cache::tags(CacheKeys::COMPANY_TAG)->clear();

        return $company->load([
            'brandDocument',
            'passportDocument',
            'stateRegisterDocument',
            'identityImages'
        ]);
    }

    public function update(Company $company, CompanyUpdateDTO $dto): Company
    {
        $company = DB::transaction(function () use ($company, $dto) {
            $company = $this->companyRepository->update($company, $dto);

            if ($dto->brand_document) {
                $this->libraryRepository->delete($company, MediaLibraryCollection::COMPANY_BRAND_DOCUMENT);
                $this->libraryRepository->addMedia(
                    $company,
                    $dto->brand_document,
                    MediaLibraryCollection::COMPANY_BRAND_DOCUMENT
                );
            }

            if ($dto->passport_document) {
                $this->libraryRepository->delete($company, MediaLibraryCollection::COMPANY_PASSPORT_DOCUMENT);
                $this->libraryRepository->addMedia(
                    $company,
                    $dto->passport_document,
                    MediaLibraryCollection::COMPANY_PASSPORT_DOCUMENT
                );
            }

            if ($dto->state_register_document) {
                $this->libraryRepository->delete($company, MediaLibraryCollection::COMPANY_STATE_REGISTER_DOCUMENT);
                $this->libraryRepository->addMedia(
                    $company,
                    $dto->state_register_document,
                    MediaLibraryCollection::COMPANY_STATE_REGISTER_DOCUMENT
                );
            }

            return $company->load([
                'brandDocument',
                'passportDocument',
                'stateRegisterDocument',
                'identityImages'
            ]);
        });

        Cache::tags(CacheKeys::COMPANY_TAG)->clear();

        return $company;
    }

    public function delete(Company $company): bool
    {
        $isDeleted = $this->companyRepository->delete($company);

        if ($isDeleted) {
            Cache::tags(CacheKeys::COMPANY_TAG)->clear();
        }

        return $isDeleted;
    }

    public function toggleStatus(Company $company, CompanyStatusDTO $payload): Company
    {
        $company = DB::transaction(function () use ($company, $payload) {
            $company = $this->companyRepository->setStatus($company, $payload);

            if ($company->status->isRejected()) {
                $this->rejectionRepository->create($company, $payload, auth()->id());
            }

            if ($payload->status->isArchived()) {
                event(new CompanyRejected($company, $payload, auth()->id()));
            }

            if ($payload->status->isActivated()) {
                $this->storeUserByCompany($company);
            }

            return $company;
        });

        Cache::tags(CacheKeys::COMPANY_TAG)->clear();

        return $company;
    }

    public function clientUpdate(Company $company, CompanyClientDTO $payload): Company
    {
        $company = DB::transaction(function () use ($company, $payload) {
            $company = $this->companyRepository->update($company, $payload);

            if ($payload->logo) {
                if ($company->logo) {
                    $this->libraryRepository->delete($company, MediaLibraryCollection::COMPANY_LOGO);
                }

                $this->libraryRepository->addMedia($company, $payload->logo, MediaLibraryCollection::COMPANY_LOGO);
            }

            return $company->load('logo');
        });

        Cache::tags(CacheKeys::COMPANY_TAG)->clear();

        return $company;
    }

    public function clientUpdateLogo(Company $company, CompanyClientLogoDTO $payload): Company
    {
        if ($payload->logo) {
            if ($company->logo) {
                $this->libraryRepository->delete($company, MediaLibraryCollection::COMPANY_LOGO);
            }

            $this->libraryRepository->addMedia($company, $payload->logo, MediaLibraryCollection::COMPANY_LOGO);
        }

        Cache::tags(CacheKeys::COMPANY_TAG)->clear();

        return $company->load('logo');
    }


    public function getAuthCompany(): Company
    {
        /** @var User $user */
        $user = auth()->user();
        $company = $user->company->load(['user', 'ratings', 'subscribers']);

        $fillable = $company->getFillable();
        $filledCount = collect($fillable)->filter(function ($field) use ($company) {
            return !is_null($company->{$field});
        })->count();
        $percentageFilled = round($filledCount / count($fillable) * 100);

        $company->offsetSet('percentageOfFilling', $percentageFilled);

        return $company;
    }

//    public function purchasesRefunds(Company $company): float|int
//    {
//        return Cache::tags(CacheKeys::COMPANY_TAG->value)
//            ->remember(
//                CacheKeys::COMPANY_PURCHASE_REFUND->value,
//                CacheKeys::ttl(),
//                fn() => $this->companyRepository->purchasesRefunds($company)
//            );
//    }

    public function score(Company $company, ?int $score): Company
    {
        $company = DB::transaction(
            fn() => $this->companyRepository->score($company, $score)
        );

        Cache::tags(CacheKeys::COMPANY_TAG->value)->clear();

        return $company->load('ratings');
    }

    public function scores(Company $company): array
    {
        return $this->companyRepository->getScoresByCompany($company);
    }

    public function getEmployees(Company $company): Collection
    {
        $cacheKey = CacheKeys::COMPANY_EMPLOYEE_LIST->setKeys(['id' => $company->id]);

        return Cache::tags(CacheKeys::COMPANY_EMPLOYEE->value)->remember($cacheKey, CacheKeys::ttl(),
            function () use ($company) {

                return $this->companyRepository->getEmployeesByCompany($company);
            });
    }

    public function getInfo(Company $company): Company
    {
        $fillable = $company->getFillable();
        $filledCount = collect($fillable)->filter(function ($field) use ($company) {
            return !is_null($company->{$field});
        })->count();
        $percentageFilled = round($filledCount / count($fillable) * 100);
        $subscribersCount = $company->subscribers()->count();
        $company_data = $this->companyRepository->getsInfoByCompany($company);

        $arrayData = array_merge($company_data, [
            'percentageFilled' => $percentageFilled,
            'subscribersCount' => $subscribersCount
        ]);
        $company->setRawAttributes($arrayData, true);
        return $company;
    }


    public function dataConfirmationCompany(Company $company, CompanyDataConfirmationDTO $payload): Company
    {
        $company = $this->companyRepository->updateFieldsDataConfirmation($company, $payload);

        $this->storeUserByCompany($company);

        Cache::tags(CacheKeys::COMPANY_TAG->value)->clear();

        return $company;
    }

    public function sendEmailWithLinkForPassword(SendEmailRequest $request): bool
    {
        $validatedData = $request->validated();

        $user = $this->userRepository->findByEmail($validatedData['email']);

        $link = $this->getTemporaryPasswordResetLink($user->email);

        $user->notify(new SendEmailWithLinkForPassword($link, $user));

        return true;
    }

    public function setPassword(string $email, string $password): User
    {
        $user = $this->userRepository->findByEmail($email);

        $user->password = bcrypt($password);

        $user->save();

        return $user;
    }

    private function getTemporaryPasswordResetLink(string $email): string
    {
        $tempUrl = URL::temporarySignedRoute(
            'api.v1.client.company.set-password',
            now()->addMinutes(10),
            ['user' => Crypt::encryptString($email)]
        );

        $queryParameters = parse_url($tempUrl, PHP_URL_QUERY);

        return config('auth.password_recovery_url') . "?$queryParameters";
    }

    public function vacancies(Company $company, VacancyFilterDTO $dto): LengthAwarePaginator
    {
        $query = $this->companyRepository->getVacanciesByCompany($company, $dto);

        return $this->companyRepository->paginate($query, $dto->perPage);
    }

    public function storeUserByCompany(Company $company): void
    {
        $user = $this->userRepository->findByEmail($company->email);
        if (!$user) {
            $user = $this->userRepository->store(
                new UserDTO(
                    name: $company->director->first_name,
                    email: $company->email,
                    password: Str::random(8)
                )
            );
        }
        $link = $this->getTemporaryPasswordResetLink($user->email);
        $user->notify(new SendEmailWithLinkForPassword($link, $user));
    }

    public function getDocuments(Company $company): Collection
    {
        return $company->media;
    }

    public function updateDomain(Company $company, string $domain): Company
    {
        $company = $this->companyRepository->updateDomain($company, $domain);

        return $company;
    }
}
