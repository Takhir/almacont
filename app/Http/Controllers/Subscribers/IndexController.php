<?php

namespace App\Http\Controllers\Subscribers;

use App\Dto\SubscribeDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Subscribe\IndexRequest;
use App\Services\PackageService;
use App\Services\PeriodService;
use App\Services\SubscriberService;
use App\Services\TownService;

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

    public function __invoke(IndexRequest $request)
    {
        $validated = $request->validated();

        $subscribeDTO = new SubscribeDTO(
            20,
            $validated['period_id'] ?? null,
            $validated['town_id'] ?? null,
            $validated['package_id'] ?? null,
        );

        $subscribers = $this->service->getAll($subscribeDTO);
        $periods = $this->periodService->getAll();
        $towns = $this->townService->all();
        $packages = $this->packageService->all();

        return view('subscribers.index', compact('subscribers', 'periods', 'towns', 'packages'));
    }
}
