<?php

namespace App\Http\Controllers\Directory\Currency;

use App\Enums\Currencies;
use App\Http\Controllers\Controller;
use App\Services\CurrencyTypeService;
use App\Services\PeriodService;

class CreateController extends Controller
{
    private PeriodService $periodService;
    private CurrencyTypeService $currencyTypeService;

    public function __construct(PeriodService $periodService, CurrencyTypeService $currencyTypeService) {
        $this->periodService = $periodService;
        $this->currencyTypeService = $currencyTypeService;
    }
    public function __invoke()
    {
        $period = $this->periodService->getAll();
        $currencies = $this->currencyTypeService->getAll();

        return view('directory.currency.create', compact('period', 'currencies'));
    }
}
