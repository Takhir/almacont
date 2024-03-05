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
        $agreements = $this->service->getAll($request);
        $periods = $this->periodService->getAll();

        return view('agreements-cards.index', compact('agreements', 'periods'));
    }
}
