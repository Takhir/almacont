<?php

namespace App\Http\Controllers\AgreementsCards;

use App\Http\Controllers\Controller;
use App\Services\AgreementCardService;
use App\Services\PeriodService;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    private AgreementCardService $service;
    private PeriodService $periodService;

    public function __construct(AgreementCardService $service, PeriodService $periodService)
    {
        $this->service = $service;
        $this->periodService = $periodService;
    }

    public function __invoke(Request $request)
    {
        $perPage = $request->input('per_page', 20);
        $periodId = $request->input('period_id');
        $agreements = $this->service->getAll($perPage, $periodId);
        $periods = $this->periodService->getAll();

        return view('agreements-cards.index', compact('agreements', 'periods'));
    }
}
