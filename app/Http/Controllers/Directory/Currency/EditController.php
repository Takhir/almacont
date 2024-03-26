<?php

namespace App\Http\Controllers\Directory\Currency;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Services\PeriodService;
use App\Services\CurrencyTypeService;

class EditController extends Controller
{
    private PeriodService $periodService;
    private CurrencyTypeService $currencyTypeService;

    public function __construct(PeriodService $periodService, CurrencyTypeService $currencyTypeService) {
        $this->periodService = $periodService;
        $this->currencyTypeService = $currencyTypeService;
    }

    public function __invoke(Currency $currency)
    {
        $period = $this->periodService->getAll();
        $currencies = $this->currencyTypeService->getAll();

        return view('directory.currency.edit', compact('period', 'currencies', 'currency'));
    }
}
