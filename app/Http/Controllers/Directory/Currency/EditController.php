<?php

namespace App\Http\Controllers\Directory\Currency;

use App\Enums\Currencies;
use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Services\PeriodService;

class EditController extends Controller
{
    private PeriodService $periodService;

    public function __construct(PeriodService $periodService) {
        $this->periodService = $periodService;
    }

    public function __invoke(Currency $currency)
    {
        $period = $this->periodService->getAll();
        $currencies = Currencies::cases();

        return view('directory.currency.edit', compact('period', 'currencies', 'currency'));
    }
}
