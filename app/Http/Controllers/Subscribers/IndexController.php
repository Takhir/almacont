<?php

namespace App\Http\Controllers\Subscribers;

use App\Http\Controllers\Controller;
use App\Services\DepartmentService;
use App\Services\PackageService;
use App\Services\PeriodService;
use App\Services\SubscriberService;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    private SubscriberService $service;
    private PeriodService $periodService;
    private DepartmentService $departmentService;

    private PackageService $packageService;

    public function __construct(SubscriberService $service, PeriodService $periodService, DepartmentService $departmentService, PackageService $packageService)
    {
        $this->service = $service;
        $this->periodService = $periodService;
        $this->departmentService = $departmentService;
        $this->packageService = $packageService;
    }

    public function __invoke(Request $request)
    {
        $subscribers = $this->service->getAll($request);
        $periods = $this->periodService->getAll();
        $towns = $this->departmentService->getTowns();
        $packages = $this->packageService->all();

        return view('subscribers.index', compact('subscribers', 'periods', 'towns', 'packages'));
    }
}
