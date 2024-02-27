<?php

namespace App\Http\Controllers\Directory\Currency;

use App\Enums\Currencies;
use App\Http\Controllers\Controller;
use App\Services\PeriodService;

class CreateController extends Controller
{
    private PeriodService $periodService;

    public function __construct(PeriodService $periodService) {
        $this->periodService = $periodService;
    }
    public function __invoke()
    {
        $period = $this->periodService->getAll();
        $currencies = Currencies::cases();

        return view('directory.currency.create', compact('period', 'currencies'));
    }
}
