<?php

namespace App\Http\Controllers\Calculations;

use App\Http\Controllers\Controller;
use App\Services\CalculationService;

class ExecuteController extends Controller
{
    private CalculationService $calculationService;

    public function __construct(CalculationService $calculationService)
    {
        $this->calculationService = $calculationService;
    }
    public function __invoke($periodId)
    {
        return $this->calculationService->execute($periodId);
    }
}
