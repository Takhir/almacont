<?php

namespace App\Http\Controllers\Calculations;

use App\Http\Controllers\Controller;
use App\Services\PeriodService;

class IndexController extends Controller
{
    private PeriodService $periodService;

    public function __construct(PeriodService $periodService)
    {
        $this->periodService = $periodService;
    }
    public function __invoke()
    {
        $periods = $this->periodService->getAll();

        return view('calculations.index', compact('periods'));
    }
}
