<?php

namespace App\Http\Controllers\AgreementsCards;

use App\Http\Controllers\Controller;
use App\Services\CurrencyService;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    private CurrencyService $service;

    public function __construct(CurrencyService $service)
    {
        $this->service = $service;
    }

    public function __invoke($periodId, Request $request)
    {
        $currencyId = $request->get('currency_id') ?? null;

        return $this->service->currenciesById($periodId, $currencyId);
    }
}
