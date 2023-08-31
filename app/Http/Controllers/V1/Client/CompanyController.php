<?php

namespace App\Http\Controllers\V1\Client;

use App\Http\Controllers\Controller;
use App\Http\Responses\ErrorResponse;
use App\Http\Responses\SuccessEmptyResponse;
use App\Http\Responses\SuccessResponse;
use App\Tbuy\Company\Models\Company;
use App\Tbuy\Company\Requests\ChangeDomainRequest;
use App\Tbuy\Company\Requests\CompanyScoreRequest;
use App\Tbuy\Company\Requests\DataConfirmationRequest;
use App\Tbuy\Company\Requests\RegisterRequest;
use App\Tbuy\Company\Requests\SendEmailRequest;
use App\Tbuy\Company\Requests\SetPasswordRequest;
use App\Tbuy\Company\Requests\UpdateClientRequest;
use App\Tbuy\Company\Requests\UpdateLogoRequest;
use App\Tbuy\Company\Resources\CompanyResource;
use App\Tbuy\Company\Resources\CompanyScoresResource;
use App\Tbuy\Company\Services\CompanyService;
use App\Tbuy\User\Resources\UserResource;
use App\Tbuy\User\Services\UserService;
use App\Tbuy\Vacancy\Requests\VacancyFilterRequest;
use Illuminate\Support\Facades\Crypt;
use App\Tbuy\Vacancy\Resources\VacancyResource;
use Symfony\Component\HttpFoundation\Response;

/**
 * @group Клиент
 * @subgroup Компании
 * @authenticated
 */
class CompanyController extends Controller
{
    public function __construct(
        private readonly CompanyService $companyService,
        private readonly UserService $userService,
    ) {
    }

    /**
     * Регистрация компании
     *
     * @bodyParam name string required Название компании. Example: ООО "Пример"
     * @bodyParam type string required Тип компании.<br/>
     * <b>sales</b> - торговля<br/>
     * <b>services</b> - услуги.<br>/
     * Example: sales
     * @bodyParam inn string required ИНН компании. Example: 1234567890
     * @bodyParam director[first_name] string required Имя директора. Example: Иван
     * @bodyParam director[last_name] string required Фамилия директора. Example: Иванов
     * @bodyParam phones[phone_director] string required Телефон компании. Example: +1234567890
     * @bodyParam email string required Email компании. Example: company@example.com
     * @bodyParam slug string required Название читаемой ссылки. Example: example-company
     * @bodyParam legal_entity int required Признак юридического лица (1, 0). Example: 1
     * @bodyParam company_address string required Адрес компании. Example: Нижний Новгород
     * @bodyParam brand_document file required Документ бренда (изображение или PDF). Максимальный размер: 5MB.
     * @bodyParam inn_document file required Документ ИНН (изображение или PDF). Максимальный размер: 5MB.
     * @bodyParam passport_document file required Документ паспорта (изображение или PDF). Максимальный размер: 5MB.
     * @bodyParam state_register_document file required Документ государственной регистрации (изображение или PDF). Максимальный размер: 5MB.
     * @bodyParam parent_id int  ID родительской компании, если есть. Example: 1
     * @bodyParam domain string nullable Домен компании, возможно добавить только один раз. Example. tbuy.am
     * @param RegisterRequest $request
     * @return SuccessResponse
     */
    public function store(RegisterRequest $request): SuccessResponse
    {
        $company = $this->companyService->store($request->toDto());

        return new SuccessResponse(
            response: CompanyResource::make($company),
            status: 201,
            message: 'Company created',
        );
    }

    /**
     * Обновление данных компании
     *
     * @urlParam company integer required ID компании. Example: 1
     * @bodyParam name array required Название компании на разных языках.
     * @bodyParam name.ru string required Название компании на русском. Example: ООО "Новое название"
     * @bodyParam name.en string required Название компании на английском. Example: New Name LLC
     * @bodyParam name.hy string required Название компании на армянском. Example: Նոր անվանում
     * @bodyParam description.ru string required Информация о компании на русском
     * @bodyParam description.en string required Информация о компании на английском
     * @bodyParam description.hy string required Информация о компании на армянском
     * @bodyParam company_address string required Адрес компании
     * @bodyParam slug string required Название читаемой ссылки. Example: new-slug
     * <b>sales</b> - торговля<br/>
     * <b>services</b> - услуги.<br>/
     * Example: sales
     * @bodyParam director array required Информация о директоре.
     * @bodyParam director.first_name string required Имя директора. Example: Петр
     * @bodyParam director.last_name string required Фамилия директора. Example: Петров
     * @bodyParam phones.phone_director string required Телефон компании. Example: +9876543210
     * @bodyParam email string required Email компании. Example: new@example.com
     * @bodyParam string required legal_name_company Юридическое имя компании
     * @responseFile status=201 storage/responses/company/update.json
     * @responseFile status=422 scenario="Validation failed" storage/responses/company/validation-failed.json
     * @param UpdateClientRequest $request
     * @param Company $company
     * @return SuccessResponse
     */
    public function update(UpdateClientRequest $request, Company $company): SuccessResponse
    {
        $company = $this->companyService->clientUpdate($company, $request->toDto());

        return new SuccessResponse(
            response: CompanyResource::make($company),
            message: 'Company updated',
        );
    }

    /**
     * Обновление логотипа компании
     *
     * @urlParam company integer required ID компании. Example: 1
     * @bodyParam logo file Логотип бренда (jpg,png)
     * @responseFile status=200 storage/responses/company/show.json
     * @param UpdateLogoRequest $request
     * @param Company $company
     * @return SuccessResponse
     */
    public function updateLogo(UpdateLogoRequest $request, Company $company): SuccessResponse
    {
        $company = $this->companyService->clientUpdateLogo($company, $request->toDto());

        return new SuccessResponse(
            response: CompanyResource::make($company),
            message: 'Company logo updated',
        );
    }

    /**
     * Подписка на компанию
     *
     * @urlParam company_id integer required ID компании. Example: 1
     * @responseFile status=200 storage/responses/company/subscribe.json
     * @param Company $company
     * @return SuccessEmptyResponse
     */
    public function subscribe(Company $company): SuccessEmptyResponse
    {
        $this->companyService->subscribe($company);

        return new SuccessEmptyResponse(
            message: 'Вы успешно подписались'
        );
    }

    /**
     * Отписка от компании
     *
     * @urlParam company_id integer required ID компании. Example: 1
     * @responseFile status=200 storage/responses/company/unsubscribe.json
     * @param Company $company
     * @return SuccessEmptyResponse
     */
    public function unsubscribe(Company $company): SuccessEmptyResponse
    {
        $this->companyService->unsubscribe($company);

        return new SuccessEmptyResponse(
            message: 'Вы успешно отписались'
        );
    }

    /**
     * Оценка компании
     *
     *
     * @urlParam company_id int required ID компании. Example: 1
     * @bodyParam score int required Оценка. От 1 до 5. Example: 3
     * @responseFile status=201 storage/responses/company/client/score.json
     * @responseFile status=422 scenario="Validation failed" storage/responses/company/client/score-validation-fail.json
     * @param CompanyScoreRequest $request
     * @param Company $company
     * @return SuccessResponse
     */
    public function score(CompanyScoreRequest $request, Company $company): SuccessResponse
    {
        $company = $this->companyService->score($company, $request->get('score'));

        return new SuccessResponse(
            response: CompanyResource::make($company),
            status: Response::HTTP_CREATED,
            message: 'Company scored'
        );
    }

    /**
     * Подтверждения компании
     *
     * @urlParam company_id integer required ID компании. Example: 1
     * @bodyParam bank_account string required Банковский счет компании. Example: 1234567889123456789
     * @bodyParam tariff_conditions_accepted_at datetime required Дата принятия основного соглашения. Example:
     * @bodyParam basic_agreement_accepted_at datetime required Дата принятия условий стандартного тарифного плана. Example:
     * @responseFile status=200 storage/responses/company/confirmation/confirm.json
     * @responseFile status=422 scenario="Validation failed" storage/responses/company/confirmation/validation-failed.json
     * @param Company $company
     * @param DataConfirmationRequest $request
     * @return SuccessResponse
     */
    public function dataConfirmation(Company $company, DataConfirmationRequest $request): SuccessResponse
    {
        $this->companyService->dataConfirmationCompany($company, $request->toDto());
        $user = $this->userService->setFirstLoginFalse($request->user());

        return new SuccessResponse(
            response: UserResource::make($user),
            status: Response::HTTP_OK,
            message: 'Вы подтвердили компанию'
        );
    }

    /**
     * Оценки компании
     *
     * @urlParam company_id integer required ID компании. Example: 1
     *
     * @responseFile status=200 storage/responses/company/client/scores.json
     * @param Company $company
     * @return SuccessResponse
     */
    public function scores(Company $company): SuccessResponse
    {
        $scores = $this->companyService->scores($company);

        return new SuccessResponse(
            response: CompanyScoresResource::make($scores),
            status: Response::HTTP_OK,
            message: 'Company scores'
        );
    }

    /**
     * Отправка письма со ссылкой на установку пароля компании(после регистрации)
     *
     * @bodyParam email string required Почта компании. Example: abc@gmail.com
     * @param SendEmailRequest $request
     * @return SuccessEmptyResponse
     */
    public function sendResetLinkEmail(SendEmailRequest $request): SuccessEmptyResponse
    {
        $this->companyService->sendEmailWithLinkForPassword($request);

        return new SuccessEmptyResponse(
            message: 'Письмо отправлено',
            status: 200
        );
    }

    /**
     * Установка пароля пользователю после регистрации его как продавец(компания)
     *
     * @bodyParam password string required Пароль
     * @queryParam email string required Email пользователя (зашифрованный)
     * @queryParam signature string required Подпись для проверки целостности
     * @queryParam expires_at datetime required Время истечения срока действия ссылки
     * @param SetPasswordRequest $request
     * @return ErrorResponse|SuccessEmptyResponse
     */
    public function setPassword(SetPasswordRequest $request): ErrorResponse|SuccessEmptyResponse
    {
        if (!$request->hasValidRelativeSignature()) {
            return new ErrorResponse('Неверная сигнатура', 403);
        }

        $encryptedEmail = $request->input('email');

        $decryptedEmail = Crypt::decryptString($encryptedEmail);

        $this->companyService->setPassword($decryptedEmail, $request->password);

        return new SuccessEmptyResponse(
            message: 'Пароль установлен'
        );
    }

    /**
     * Список вакансии по компании
     *
     * @urlParam company_id integer required ID компании. Example: 1
     * @bodyParam category_id int id категории. Example: 5
     * @bodyParam status string id категории. Example: active
     * @responseFile storage/responses/company/client/vacancies.json
     * @param Company $company
     * @param VacancyFilterRequest $request
     * @return SuccessResponse
     */
    public function vacancies(Company $company, VacancyFilterRequest $request): SuccessResponse
    {
        $vacancies = $this->companyService->vacancies($company, $request->toDto());

        return new SuccessResponse(
            response: VacancyResource::collection($vacancies),
            message: 'vacancy list'
        );
    }

    /**
     * Изменяем домаин
     *
     * @urlParam company_id int required. Example: 2
     * @bodyParam approve bool nullable. Example: 0
     * @bodyParam domain string nullable Домен компании, возможно добавить только один раз. Example: tbuy.am
     * @responseFile storage/responses/company/client/update-domain.json
     * @responseFile storage/responses/company/client/show.json
     *
     * @param Company $company
     * @param ChangeDomainRequest $request
     *
     * @return SuccessResponse|SuccessEmptyResponse
     */
    public function updateDomain(ChangeDomainRequest $request, Company $company): SuccessEmptyResponse|SuccessResponse
    {
        if ($request->approve) {
            $company = $this->companyService->updateDomain($company, $request->domain);

            return new SuccessResponse(
                response: new CompanyResource($company),
                message: 'domain successfully changed'
            );
        }

        return new SuccessEmptyResponse(
            message: 'domain is valid'
        );
    }
}
