<?php

namespace App\Http\Controllers\Subscribers;

use App\Http\Controllers\Controller;
use App\Services\TownService;
use App\Services\PackageService;
use App\Services\PeriodService;
use App\Services\SubscriberService;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    private SubscriberService $service;
    private PeriodService $periodService;
    private TownService $townService;

    private PackageService $packageService;

    public function __construct(SubscriberService $service, PeriodService $periodService, TownService $townService, PackageService $packageService)
    {
        $this->service = $service;
        $this->periodService = $periodService;
        $this->townService = $townService;
        $this->packageService = $packageService;
    }

    public function __invoke(Request $request)
    {
        $subscribers = $this->service->getAll($request);
        $periods = $this->periodService->getAll();
        $towns = $this->townService->all();
        $packages = $this->packageService->all();

        return view('subscribers.index', compact('subscribers', 'periods', 'towns', 'packages'));
    }
}
