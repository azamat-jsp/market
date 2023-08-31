<?php

namespace App\Http\Controllers\V1\Client;

use App\Http\Controllers\Controller;
use App\Http\Responses\ErrorResponse;
use App\Http\Responses\SuccessEmptyResponse;
use App\Http\Responses\SuccessResponse;
use App\Tbuy\Tariff\Exceptions\BalanceNotEnoughException;
use App\Tbuy\Tariff\Models\Tariff;
use App\Tbuy\Tariff\Requests\BuyRequest;
use App\Tbuy\Tariff\Resources\TariffBuyedResource;
use App\Tbuy\Tariff\Resources\TariffResource;
use App\Tbuy\Tariff\Services\TariffService;
use App\Tbuy\User\Resources\UserResource;
use Illuminate\Contracts\Support\Responsable;
use Symfony\Component\HttpFoundation\Response;

/**
 * @group Клиент
 * @subgroup Тарифы
 * @authenticated
 */
class TariffController extends Controller
{
    public function __construct(
        public readonly TariffService $tariffService
    )
    {
    }

    /**
     * Получение списка тарифов
     *
     * @responseFile storage/responses/tariff/index.json
     * @return SuccessResponse
     */
    public function index(): SuccessResponse
    {
        return new SuccessResponse(
            response: TariffResource::collection($this->tariffService->get()),
            message: 'Список тарифов'
        );
    }

    /**
     * Покупка тарифа
     *
     * @urlParam tariff_id integer required ID тарифа. Example: 1
     * @bodyParam term_month required int Кол-во месяцев действия тарифа. Example: 6
     * @responseFile status=200 storage/responses/tariff/buy.json
     * @responseFile status=422 scenario="Validation failed" storage/responses/tariff/buy-validation-failed.json
     * @responseFile status=422 scenario="Validation failed wrong month" storage/responses/tariff/buy-wrong-month-validation-failed.json
     * @responseFile status=400 scenario="Balance not enough" storage/responses/tariff/balance-not-enough.json
     * @param BuyRequest $request
     * @param Tariff $tariff
     * @return SuccessResponse
     */
    public function buy(BuyRequest $request, Tariff $tariff): Responsable
    {
        try {
            $user = $this->tariffService->buy($tariff, $request->toDto());
        } catch (\Throwable|BalanceNotEnoughException $exception) {
            return new ErrorResponse(
                message: $exception->getMessage(),
                status: 400
            );
        }

        return new SuccessResponse(
            response: TariffBuyedResource::make(['user' => $user, 'tariff' => $tariff]),
            message: 'Тариф куплен'
        );
    }
}
